from rest_framework import generics
from .models import Shipment
from .serializers import ShipmentSerializer


class ShipmentListCreateView(generics.ListCreateAPIView):
    queryset = Shipment.objects.all().order_by('id')
    serializer_class = ShipmentSerializer
