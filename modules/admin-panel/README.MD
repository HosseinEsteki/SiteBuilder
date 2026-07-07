
markdown

#AdminPanel Module

ماژول AdminPanel یک پنل مدیریت مرکزی بر پایه Filament v5 است که منابع (Resources) همه ماژول‌های پروژه را مدیریت می‌کند. این ماژول به صورت یک پکیج مستقل توسعه داده شده و قابلیت اتصال به سایر ماژول‌ها مثل Blog، Shop و CMS را دارد.

---

✨ امکانات
- مدیریت منابع (Product, Article, Page, Order)
- داشبورد اختصاصی با ویجت‌های آماری
- مدیریت نقش‌ها و دسترسی‌ها (Role & Permission) با پکیج spatie/laravel-permission
- اتصال به ماژول‌های دیگر پروژه
- ساختار ماژولار و قابل توسعه

---

📦 نصب

۱. اضافه کردن ماژول به پروژه
در فایل composer.json اصلی پروژه:
```json
"repositories": [
    {
        "type": "path",
        "url": "modules/AdminPanel",
        "options": {
        "symlink": true
        }
    }
],
"require": {
  "hosseinesteki/admin-panel": "^1.0"
}
```

سپس:
```bash
composer update
```

۲. نصب فیلامنت
```bash
php artisan filament:install
```

---

⚙️ تنظیمات
- سرویس‌پروایدر: AdminPanel\Providers\AdminPanelServiceProvider
- مایگریشن‌ها: modules/AdminPanel/Database/migrations

اجرای مایگریشن‌ها:
```bash
php artisan migrate
```

---

📂 ساختار پوشه‌ها
```
modules/
└── AdminPanel/
├── config/
│    └── filament.php
├── Database/
│    └── migrations/
├── resources/
│    └── views/
└── src/
├── Resources/
│    ├── ProductResource.php
│    ├── ArticleResource.php
│    ├── PageResource.php
│    └── OrderResource.php
├── Pages/
│    └── Dashboard.php
├── Widgets/
│    ├── StatsOverview.php
│    └── LatestOrders.php
└── Providers/
└── AdminPanelServiceProvider.php
```

---

🚀 استفاده
- ورود به پنل: /admin
- مدیریت منابع: از طریق منوی فیلامنت
- داشبورد: نمایش آمار کلی و ویجت‌های سفارشی
- مدیریت نقش‌ها: از طریق Resourceهای Role و Permission

---

🛡️ نقش‌ها و دسترسی‌ها
- Super Admin: دسترسی کامل به همه بخش‌ها
- Admin: مدیریت منابع اصلی
- Editor: مدیریت محتوا (مقالات و صفحات)
- Seller: مدیریت محصولات و سفارش‌ها
- Customer: دسترسی محدود به پروفایل و سفارش‌ها

---

📌 توسعه
برای ساخت Resource جدید:
```bash
php artisan make:filament-resource ModelName --panel=Admin
```

برای ساخت ویجت جدید:
```bash
php artisan make:filament-widget WidgetName --panel=Admin
```

---

📝 لایسنس
این ماژول تحت لایسنس MIT منتشر شده است.


---
