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

## Cài đặt

```bash
# Clone dự án
git clone https://github.com/NhuanDoan/LofiPlan.git
cd LofiPlan

# Cài đặt backend
composer install
cp .env.example .env
php artisan key:generate

# Cài đặt frontend
npm install
npm run dev

# Chạy server
# Do đã config:
"scripts": {
        "dev": "npm-run-all --parallel serve php",
        "serve": "vite",
        "php": "php artisan serve",
        "build": "vite build"
    },
# Nên lệnh start sevrer là
npm run dev
