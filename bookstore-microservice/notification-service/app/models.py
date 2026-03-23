from django.db import models


class Notification(models.Model):
    customer_id = models.IntegerField()
    title = models.CharField(max_length=100)
    message = models.TextField()
    sent = models.BooleanField(default=True)

