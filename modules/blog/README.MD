# Blog Module - Laravel Site Builder

این ماژول بخشی از **سایت‌ساز لاراول** است که امکان مدیریت و انتشار بلاگ را فراهم می‌کند.

---

## ✨ امکانات
- ایجاد، ویرایش و حذف پست‌های بلاگ
- دسته‌بندی و برچسب‌گذاری مطالب
- مدیریت نویسندگان و نقش‌ها
- پشتیبانی از ویرایشگر WYSIWYG
- قابلیت جستجو در مطالب
- API برای دسترسی به پست‌ها
- سیستم کامنت‌گذاری (اختیاری)

---

## 📦 نصب و راه‌اندازی
1. کلون کردن پروژه:
   ```bash
   git clone https://github.com/hosseiesteki/blog.git
   cd blog
   ```
2. نصب وابستگی‌ها:

```bash
composer install
npm install && npm run dev
```
3. تنظیم فایل .env:
- اتصال به دیتابیس
- تنظیمات مربوط به storage و queue
- اجرای migration و seeder:
```bash
php artisan migrate --seed
```
🚀 استفاده
- ورود به پنل مدیریت: /admin/blog
- ایجاد پست جدید: دکمه‌ی New Post
- مدیریت دسته‌بندی‌ها: /admin/blog/categories
- دسترسی API:
- لیست پست‌ها: GET /api/blog/posts
- جزئیات پست: GET /api/blog/posts/{id}

🛠 توسعه
- مسیرهای اصلی در فایل routes/blog.php
- کنترلرها در App\Http\Controllers\Blog
- مدل‌ها در App\Models\Blog
- ویوها در resources/views/blog

📖 راهنما
- برای افزودن قابلیت جدید (مثلاً لایک کردن پست‌ها)، یک migration جدید بسازید و مدل مربوطه را توسعه دهید.
- برای تغییر ظاهر بلاگ، فایل‌های Blade در مسیر resources/views/blog را ویرایش کنید.

🤝 مشارکت
پول‌ریکوئست‌ها و گزارش باگ‌ها خوشحال‌کننده‌اند! لطفاً قبل از ارسال، تست‌ها را اجرا کنید:
```bash
php artisan test
```
📜 مجوز
این پروژه تحت مجوز MIT منتشر شده است.




