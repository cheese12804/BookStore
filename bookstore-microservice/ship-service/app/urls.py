from django.urls import path
from .views import ShipmentListCreateView

urlpatterns = [
    path('shipments/', ShipmentListCreateView.as_view()),
]
