from django.urls import path
from .views import BookSearchView

urlpatterns = [
    path('search/books/', BookSearchView.as_view()),
]
