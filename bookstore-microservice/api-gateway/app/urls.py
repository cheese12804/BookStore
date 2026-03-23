from django.urls import path
from .views import HomePageView, BookListPageView, CartPageView, SearchBookPageView, OrderCreatePageView

urlpatterns = [
    path('', HomePageView.as_view()),
    path('books/', BookListPageView.as_view()),
    path('cart/<int:customer_id>/', CartPageView.as_view()),
    path('search/', SearchBookPageView.as_view()),
    path('orders/', OrderCreatePageView.as_view()),
]
