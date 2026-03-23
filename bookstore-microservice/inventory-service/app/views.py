from rest_framework import generics
from .models import Inventory
from .serializers import InventorySerializer


class InventoryListCreateView(generics.ListCreateAPIView):
    queryset = Inventory.objects.all().order_by('id')
    serializer_class = InventorySerializer


class InventoryDetailView(generics.RetrieveUpdateAPIView):
    queryset = Inventory.objects.all()
    serializer_class = InventorySerializer
