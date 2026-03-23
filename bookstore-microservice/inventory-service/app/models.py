from django.db import models


class Inventory(models.Model):
    book_id = models.IntegerField(unique=True)
    available = models.IntegerField(default=0)

