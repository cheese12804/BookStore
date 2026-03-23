from rest_framework import serializers
from .models import EventLog


class EventLogSerializer(serializers.ModelSerializer):
    class Meta:
        model = EventLog
        fields = ['id', 'service', 'action', 'payload', 'created_at']
