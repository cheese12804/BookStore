# BookStore Microservice (Assignment 05)

## 1. Giới thiệu hệ thống
Hệ thống BookStore theo kiến trúc **12 services** (mỗi service là Django project độc lập, DB SQLite riêng).

## 2. Danh sách 12 services
1. customer-service
2. book-service
3. cart-service
4. order-service
5. pay-service
6. ship-service
7. comment-rate-service
8. inventory-service
9. notification-service
10. search-service
11. analytics-service
12. api-gateway (UI)

## 3. UI đã có chưa?
**Có UI** ở `api-gateway`:
- `/` trang chủ demo
- `/books/` danh sách sách
- `/search/?q=...` tìm kiếm sách
- `/cart/<customer_id>/` xem giỏ hàng
- `/orders/` form tạo order

## 4. Cách chạy Docker Compose
```bash
cd bookstore-microservice
docker compose up --build -d
```

## 5. Migrate cho tất cả services
```bash
docker compose exec customer-service python manage.py makemigrations app && docker compose exec customer-service python manage.py migrate
docker compose exec book-service python manage.py makemigrations app && docker compose exec book-service python manage.py migrate
docker compose exec cart-service python manage.py makemigrations app && docker compose exec cart-service python manage.py migrate
docker compose exec order-service python manage.py makemigrations app && docker compose exec order-service python manage.py migrate
docker compose exec pay-service python manage.py makemigrations app && docker compose exec pay-service python manage.py migrate
docker compose exec ship-service python manage.py makemigrations app && docker compose exec ship-service python manage.py migrate
docker compose exec comment-rate-service python manage.py makemigrations app && docker compose exec comment-rate-service python manage.py migrate
docker compose exec inventory-service python manage.py makemigrations app && docker compose exec inventory-service python manage.py migrate
docker compose exec notification-service python manage.py makemigrations app && docker compose exec notification-service python manage.py migrate
docker compose exec search-service python manage.py migrate
docker compose exec analytics-service python manage.py makemigrations app && docker compose exec analytics-service python manage.py migrate
docker compose exec api-gateway python manage.py migrate
```

## 6. Endpoint chính
- customer-service: `/customers/`
- book-service: `/books/`
- cart-service: `/carts/`, `/cart-items/`
- order-service: `/orders/`
- pay-service: `/payments/`
- ship-service: `/shipments/`
- comment-rate-service: `/reviews/`
- inventory-service: `/inventories/`
- notification-service: `/notifications/`
- search-service: `/search/books/?q=`
- analytics-service: `/events/`

## 7. Kịch bản demo chính
1. Tạo customer (auto tạo cart).
2. Staff tạo sách.
3. Customer add vào cart.
4. Customer xem cart.
5. Customer tạo order (gọi pay + ship).
6. Customer đánh giá sách.
7. Mở UI ở `http://localhost:8000/` để demo.
