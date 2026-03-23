from django.urls import path
from .views import CartCreateView, CartByCustomerView, CartItemCreateView, CartItemDetailView

urlpatterns = [
    path('carts/', CartCreateView.as_view()),
    path('carts/<int:customer_id>/', CartByCustomerView.as_view()),
    path('cart-items/', CartItemCreateView.as_view()),
    path('cart-items/<int:pk>/', CartItemDetailView.as_view()),
]
