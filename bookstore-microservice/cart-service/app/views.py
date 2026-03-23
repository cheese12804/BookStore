import requests
from django.shortcuts import get_object_or_404
from rest_framework import status
from rest_framework.response import Response
from rest_framework.views import APIView
from .models import Cart, CartItem
from .serializers import CartSerializer, CartItemSerializer


class CartCreateView(APIView):
    def post(self, request):
        customer_id = request.data.get('customer_id')
        if not customer_id:
            return Response({'error': 'customer_id is required'}, status=status.HTTP_400_BAD_REQUEST)
        cart, _ = Cart.objects.get_or_create(customer_id=customer_id)
        return Response(CartSerializer(cart).data, status=status.HTTP_201_CREATED)


class CartByCustomerView(APIView):
    def get(self, request, customer_id):
        cart = get_object_or_404(Cart, customer_id=customer_id)
        return Response(CartSerializer(cart).data)


class CartItemCreateView(APIView):
    def post(self, request):
        customer_id = request.data.get('customer_id')
        book_id = request.data.get('book_id')
        quantity = request.data.get('quantity', 1)

        if not customer_id or not book_id:
            return Response({'error': 'customer_id and book_id are required'}, status=status.HTTP_400_BAD_REQUEST)

        cart = get_object_or_404(Cart, customer_id=customer_id)

        try:
            resp = requests.get('http://book-service:8000/books/', timeout=5)
            resp.raise_for_status()
            books = resp.json()
        except requests.RequestException:
            return Response({'error': 'Cannot verify books'}, status=status.HTTP_503_SERVICE_UNAVAILABLE)

        if not any(book['id'] == int(book_id) for book in books):
            return Response({'error': 'Book not found'}, status=status.HTTP_404_NOT_FOUND)

        item = CartItem.objects.create(cart=cart, book_id=book_id, quantity=quantity)
        return Response(CartItemSerializer(item).data, status=status.HTTP_201_CREATED)


class CartItemDetailView(APIView):
    def put(self, request, pk):
        item = get_object_or_404(CartItem, pk=pk)
        serializer = CartItemSerializer(item, data=request.data, partial=True)
        serializer.is_valid(raise_exception=True)
        serializer.save()
        return Response(serializer.data)

    def delete(self, request, pk):
        item = get_object_or_404(CartItem, pk=pk)
        item.delete()
        return Response(status=status.HTTP_204_NO_CONTENT)
