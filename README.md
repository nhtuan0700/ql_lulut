# Run project
1. Create file .env form .env.example
2. `composer install`
3. `php artisan key:generate`s
4. Creat new database s
5. `php artisan migrate:fresh --seed`
6. `php artisan serve`

# List account test:
1. Quản trị viên: phuc@test.com/123123
2. Cán bộ quản lý phân phối: phuc+1@test.com/123123
3. Cán bộ: phuc+2@test.com/123123
4. Người ủng hộ: phuc+3@test.com/123123
4. Chủ hộ gia đình: phuc+4@test.com/123123

# use case
1. Quản trị viên
  - Quản lý tài khoản hệ thống - x
  - Quản lý hộ gia đình - x
  - Bài viết - x
2. Cán bộ quản lý phân phối
  - Quản lý đợt ủng hộ
  - Duyệt:
    + Đăng ký ủng hộ
  - Phân bố hàng cứu trợ cho xã yêu cầu
3. Cán bộ phường
  - Cập nhật danh sách hộ gia đình cần được cứu trợ 
  - Xác nhận phân phối hàng cứu trợ tại đơn vị 
4. Người ủng hộ
  - Đăng ký ủng hộ
  - Xem lịch sử đã đăng ký ủng hộ
5. Khách vãng lai
  - Xem bài viết - x
6. Chủ hộ gia đình
  - Xem lịch sử được ủng hộ