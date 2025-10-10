<h1 align="center">LofiPlan</h1>

<p align="center">
  <em>Ứng dụng nghe nhạc thư giãn và lên kế hoạch cá nhân – giúp bạn giữ tinh thần cân bằng và tập trung mỗi ngày.</em>
</p>

---

## Giới thiệu

**LofiPlan** là ứng dụng web kết hợp giữa âm nhạc và quản lý công việc, giúp bạn:
- Nghe nhạc **Lofi Chill** để thư giãn hoặc tập trung làm việc.  
- Lên lịch và theo dõi công việc hằng ngày.  
- Giữ tinh thần **tỉnh táo, cân bằng và sáng tạo** trong không gian yên tĩnh.  

Giao diện mang phong cách tối giản, hiện đại và yên bình, được thiết kế dành riêng cho những ai yêu thích sự tập trung và thư giãn cùng âm nhạc.

---

## Tính năng chính

- Trình phát nhạc mini: phát / tạm dừng / chuyển bài / chỉnh âm lượng.  
- Quản lý công việc và lịch trình cá nhân.  
- Xác thực người dùng (đăng ký, đăng nhập, quên mật khẩu, đổi mật khẩu).  
- Không gian làm việc yên tĩnh giúp tăng hiệu suất.

---

## Công nghệ sử dụng

| Thành phần | Công nghệ |
|-------------|------------|
| **Frontend** | React + TailwindCSS + Lucide Icons |
| **Backend** | Laravel 11 |
| **Cơ sở dữ liệu** | MySQL |
| **Build tool** | Vite |
| **Triển khai** | Localhost |

---

# Cài đặt
## Clone dự án

- git clone https://github.com/NhuanDoan/LofiPlan.git
- cd LofiPlan

## 1. Cài đặt Backend (Laravel)

**Chạy các lệnh:**
- composer install 
- cp .env.example .env
 -php artisan key:generate

**Mở file .env và chỉnh thông tin kết nối:**

- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=music_db
- DB_USERNAME=root
- DB_PASSWORD=

**Tạo bảng dữ liệu:**

- php artisan migrate

## 2. Cài đặt Frontend (React + Vite)

- npm install

## 3. Cấu hình chạy song song

**Mở file package.json, thêm phần:**

"scripts": {
  "dev": "npm-run-all --parallel serve php",
  "serve": "vite",
  "php": "php artisan serve",
  "build": "vite build"
}

**Nếu chưa có gói npm-run-all, cài thêm:**
- npm install npm-run-all --save-dev

## 4. Cấp quyền lưu file (macOS / Linux)

**Chạy các lệnh:**
- sudo chmod -R 775 storage bootstrap/cache
- sudo chmod -R 775 public/storage
- sudo chmod -R 775 public/storage/songs public/storage/covers

## 5. Tạo liên kết thư mục lưu trữ

**Chạy lệnh:** php artisan storage:link
- **Kết quả:** The [public/storage] directory has been linked.

## 6. Chạy dự án 

**Chạy lệnh:** npm run dev

- Laravel server: http://localhost:8000 (Hoàn tất vào link này là được)
- Vite server: http://localhost:5173
