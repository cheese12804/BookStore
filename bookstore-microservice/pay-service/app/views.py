from rest_framework import generics
from .models import Payment
from .serializers import PaymentSerializer


class PaymentListCreateView(generics.ListCreateAPIView):
    queryset = Payment.objects.all().order_by('id')
    serializer_class = PaymentSerializer
