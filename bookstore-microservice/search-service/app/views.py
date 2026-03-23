import requests
from rest_framework.response import Response
from rest_framework.views import APIView


class BookSearchView(APIView):
    def get(self, request):
        query = request.query_params.get('q', '').lower()
        books = []
        try:
            resp = requests.get('http://book-service:8000/books/', timeout=5)
            if resp.ok:
                books = resp.json()
        except requests.RequestException:
            books = []

        if query:
            books = [b for b in books if query in b['title'].lower() or query in b['author'].lower()]
        return Response(books)
