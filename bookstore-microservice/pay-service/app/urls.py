from django.urls import path
from .views import PaymentListCreateView

urlpatterns = [
    path('payments/', PaymentListCreateView.as_view()),
]
