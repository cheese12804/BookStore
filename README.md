# BookStore MVC (PHP + XAMPP)

Dự án mẫu web bookstore viết theo mô hình MVC, chạy trên XAMPP.

## Cấu trúc
- `app/Models`: 20 model có cấu hình `table`, `fillable` và method truy vấn.
- `app/Services`: 12 service xử lý nghiệp vụ (auth, sách, đơn hàng, kho, mã giảm giá...).
- `app/Controllers`: controller xử lý luồng.
- `app/Views`: giao diện.
- `public`: điểm vào ứng dụng.
- `config`: cấu hình database.

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

## Điểm mới
- `App\Core\Model` có sẵn CRUD dùng prepared statement: `findAll`, `findById`, `create`, `updateById`, `deleteById`, `count`.
- Service đã có nghiệp vụ mẫu thực tế hơn (đăng ký tài khoản, tìm sách, áp mã giảm giá, tạo vận đơn, ghi nhận thanh toán...).
- Các service có cơ chế fallback data để trang vẫn chạy được khi chưa kết nối DB.
