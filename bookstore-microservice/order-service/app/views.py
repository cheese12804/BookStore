from decimal import Decimal
import requests
from django.shortcuts import get_object_or_404
from rest_framework import status
from rest_framework.response import Response
from rest_framework.views import APIView
from .models import Order, OrderItem
from .serializers import OrderSerializer


class OrderListCreateView(APIView):
    def get(self, request):
        orders = Order.objects.all().order_by('id')
        return Response(OrderSerializer(orders, many=True).data)

    def post(self, request):
        customer_id = request.data.get('customer_id')
        pay_method = request.data.get('pay_method')
        ship_method = request.data.get('ship_method')
        shipping_address = request.data.get('shipping_address')

        if not all([customer_id, pay_method, ship_method, shipping_address]):
            return Response({'error': 'Missing required fields'}, status=status.HTTP_400_BAD_REQUEST)

        try:
            cart_resp = requests.get(f'http://cart-service:8000/carts/{customer_id}/', timeout=5)
            cart_resp.raise_for_status()
            cart = cart_resp.json()
            books_resp = requests.get('http://book-service:8000/books/', timeout=5)
            books_resp.raise_for_status()
            books = books_resp.json()
        except requests.RequestException:
            return Response({'error': 'Unable to read cart or books'}, status=status.HTTP_503_SERVICE_UNAVAILABLE)

        book_map = {b['id']: b for b in books}
        cart_items = cart.get('items', [])
        if not cart_items:
            return Response({'error': 'Cart is empty'}, status=status.HTTP_400_BAD_REQUEST)

        total = Decimal('0.00')
        priced_items = []
        for item in cart_items:
            book = book_map.get(item['book_id'])
            if not book:
                return Response({'error': f"Book {item['book_id']} not found"}, status=status.HTTP_400_BAD_REQUEST)
            price = Decimal(str(book['price']))
            qty = int(item['quantity'])
            total += price * qty
            priced_items.append((item['book_id'], qty, price))

        order = Order.objects.create(
            customer_id=customer_id,
            total_amount=total,
            pay_method=pay_method,
            ship_method=ship_method,
            shipping_address=shipping_address,
            status='PENDING',
        )

        for book_id, qty, price in priced_items:
            OrderItem.objects.create(order=order, book_id=book_id, quantity=qty, price=price)

        payment_ok = False
        shipment_ok = False
        try:
            pay_resp = requests.post(
                'http://pay-service:8000/payments/',
                json={'order_id': order.id, 'amount': str(total), 'method': pay_method},
                timeout=5,
            )
            payment_ok = pay_resp.status_code in (200, 201)
        except requests.RequestException:
            payment_ok = False

        try:
            ship_resp = requests.post(
                'http://ship-service:8000/shipments/',
                json={'order_id': order.id, 'address': shipping_address, 'method': ship_method},
                timeout=5,
            )
            shipment_ok = ship_resp.status_code in (200, 201)
        except requests.RequestException:
            shipment_ok = False

        order.status = 'CONFIRMED' if payment_ok and shipment_ok else 'FAILED'
        order.save()

        return Response(OrderSerializer(order).data, status=status.HTTP_201_CREATED)


class OrderDetailView(APIView):
    def get(self, request, pk):
        order = get_object_or_404(Order, pk=pk)
        return Response(OrderSerializer(order).data)
