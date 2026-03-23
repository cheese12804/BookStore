import requests
from rest_framework import status
from rest_framework.response import Response
from rest_framework.views import APIView
from .models import Customer
from .serializers import CustomerSerializer


class CustomerListCreateView(APIView):
    def get(self, request):
        customers = Customer.objects.all().order_by('id')
        return Response(CustomerSerializer(customers, many=True).data)

    def post(self, request):
        serializer = CustomerSerializer(data=request.data)
        serializer.is_valid(raise_exception=True)
        customer = serializer.save()

        try:
            requests.post(
                'http://cart-service:8000/carts/',
                json={'customer_id': customer.id},
                timeout=5,
            )
        except requests.RequestException:
            pass

        return Response(CustomerSerializer(customer).data, status=status.HTTP_201_CREATED)
