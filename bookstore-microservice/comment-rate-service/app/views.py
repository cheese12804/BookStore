from rest_framework import generics
from .models import CommentRate
from .serializers import CommentRateSerializer


class ReviewListCreateView(generics.ListCreateAPIView):
    queryset = CommentRate.objects.all().order_by('id')
    serializer_class = CommentRateSerializer


class ReviewByBookView(generics.ListAPIView):
    serializer_class = CommentRateSerializer

    def get_queryset(self):
        return CommentRate.objects.filter(book_id=self.kwargs['book_id']).order_by('id')
