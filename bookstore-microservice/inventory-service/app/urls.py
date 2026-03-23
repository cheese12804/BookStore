from django.urls import path
from .views import InventoryListCreateView, InventoryDetailView

urlpatterns = [
    path('inventories/', InventoryListCreateView.as_view()),
    path('inventories/<int:pk>/', InventoryDetailView.as_view()),
]
