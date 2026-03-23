from django.urls import path
from .views import EventLogListCreateView

urlpatterns = [
    path('events/', EventLogListCreateView.as_view()),
]
