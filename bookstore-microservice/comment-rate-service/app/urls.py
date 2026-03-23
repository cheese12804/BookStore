from django.urls import path
from .views import ReviewListCreateView, ReviewByBookView

urlpatterns = [
    path('reviews/', ReviewListCreateView.as_view()),
    path('reviews/book/<int:book_id>/', ReviewByBookView.as_view()),
]
