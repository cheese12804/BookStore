# BookStore MVC (PHP + XAMPP)

Dự án mẫu web bookstore viết theo mô hình MVC, chạy trên XAMPP.

## Cấu trúc
- `app/Models`: 20 model
- `app/Services`: 12 service
- `app/Controllers`: controller xử lý luồng
- `app/Views`: giao diện
- `public`: điểm vào ứng dụng
- `config`: cấu hình database

## Chạy với XAMPP
1. Copy dự án vào thư mục `htdocs`, ví dụ: `C:\xampp\htdocs\BookStore`.
2. Mở XAMPP Control Panel, start `Apache` và `MySQL`.
3. Tạo database `bookstore` trong phpMyAdmin.
4. Cập nhật thông tin trong `config/database.php` nếu cần.
5. Mở trình duyệt:
   - `http://localhost/BookStore/public`

## Danh sách model (20)
User, Role, Author, Publisher, Category, Book, BookImage, Inventory, Warehouse, Cart, CartItem, Order, OrderItem, Payment, Shipment, Review, Wishlist, Coupon, Address, Notification.

## Danh sách service (12)
AuthService, BookService, CategoryService, CartService, OrderService, PaymentService, ShipmentService, InventoryService, ReviewService, WishlistService, CouponService, ReportService.
