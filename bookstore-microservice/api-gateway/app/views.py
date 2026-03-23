import requests
from django.shortcuts import render
from django.views import View


class HomePageView(View):
    def get(self, request):
        return render(request, 'home.html')


class BookListPageView(View):
    def get(self, request):
        books = []
        try:
            resp = requests.get('http://book-service:8000/books/', timeout=5)
            if resp.ok:
                books = resp.json()
        except requests.RequestException:
            books = []
        return render(request, 'books.html', {'books': books})


class CartPageView(View):
    def get(self, request, customer_id):
        cart = None
        error = None
        try:
            resp = requests.get(f'http://cart-service:8000/carts/{customer_id}/', timeout=5)
            if resp.ok:
                cart = resp.json()
            else:
                error = resp.text
        except requests.RequestException as exc:
            error = str(exc)
        return render(request, 'cart.html', {'cart': cart, 'customer_id': customer_id, 'error': error})


class SearchBookPageView(View):
    def get(self, request):
        q = request.GET.get('q', '')
        books = []
        if q:
            try:
                resp = requests.get('http://search-service:8000/search/books/', params={'q': q}, timeout=5)
                if resp.ok:
                    books = resp.json()
            except requests.RequestException:
                books = []
        return render(request, 'search.html', {'q': q, 'books': books})


class OrderCreatePageView(View):
    def get(self, request):
        return render(request, 'order_form.html')

    def post(self, request):
        payload = {
            'customer_id': request.POST.get('customer_id'),
            'pay_method': request.POST.get('pay_method'),
            'ship_method': request.POST.get('ship_method'),
            'shipping_address': request.POST.get('shipping_address'),
        }

        order = None
        error = None
        try:
            resp = requests.post('http://order-service:8000/orders/', json=payload, timeout=5)
            if resp.ok:
                order = resp.json()
            else:
                error = resp.text
        except requests.RequestException as exc:
            error = str(exc)

        return render(request, 'order_result.html', {'order': order, 'error': error})
