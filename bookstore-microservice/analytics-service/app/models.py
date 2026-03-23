from django.db import models


class EventLog(models.Model):
    service = models.CharField(max_length=50)
    action = models.CharField(max_length=100)
    payload = models.TextField(blank=True, null=True)
    created_at = models.DateTimeField(auto_now_add=True)

