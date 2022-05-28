# Run project
1. Create file .env form .env.example
2. `composer install`
3. `php artisan key:generate`s
4. Creat new database s
5. `php artisan migrate:fresh --seed`
6. `php artisan serve`

# List account test:
1. Admin: phuc@test.com/123123
2. Nhân viên kho: phuc+1@test.com/123123
3. Cán bộ: phuc+2@test.com/123123
4. Người ủng hộ: phuc+3@test.com/123123

# use case
1. Admin
  - Quản lý tài khoản hệ thống - x
  - Bài viết - x
  - Quản lý hộ gia đình - x
  - Quản lý đợt ủng hộ
  - Duyệt:
    + Các gia đình được cứu trợ
    + Đăng ký ủng hộ
2. Nhân viên kho
  - Cập nhật phiếu nhập
  - Cập nhật phiếu phân phối hàng cứu trợ
3. Cán bộ
  - Cập nhật danh sách hộ gia đình cần được cứu trợ
  - Xác nhận phân phối hàng cứu trợ tại đơn vị
4. Người ủng hộ
  - Đăng ký ủng hộ
  - Xem lịch sử đã đăng ký ủng hộ
5. Khách vãng lai
  - Xem bài viết - x