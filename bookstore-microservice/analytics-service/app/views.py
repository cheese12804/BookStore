from rest_framework import generics
from .models import EventLog
from .serializers import EventLogSerializer


class EventLogListCreateView(generics.ListCreateAPIView):
    queryset = EventLog.objects.all().order_by('-id')
    serializer_class = EventLogSerializer
