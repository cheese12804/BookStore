from rest_framework import serializers
from .models import CommentRate


class CommentRateSerializer(serializers.ModelSerializer):
    class Meta:
        model = CommentRate
        fields = ['id', 'customer_id', 'book_id', 'rating', 'comment']
