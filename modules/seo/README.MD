# 📦 SEO Module for Laravel

ماژول سئو برای لاراول، ابزاری جامع جهت مدیریت متاتگ‌ها، اسکیما (JSON-LD)، Sitemap و Redirectهاست. این ماژول به شما کمک می‌کند تا سئو پروژه‌های لاراولی خود را به صورت ماژولار و قابل توسعه مدیریت کنید.

---

## 🚀 امکانات
- **Meta Manager**: مدیریت عنوان، توضیحات، کلمات کلیدی، Canonical، OpenGraph و Twitter Card.
- **Schema Generator**: تولید JSON-LD برای Article, Product, Organization, Category, Tag.
- **Sitemap Generator**: تولید فایل `sitemap.xml` شامل مسیرهای استاتیک و داینامیک.
- **Redirects**: مدیریت ریدایرکت‌ها برای جلوگیری از خطای 404 و حفظ SEO.
- **Facade SEO**: دسترسی یکپارچه به همه‌ی قابلیت‌ها با یک خط کد.

---

## 📥 نصب
```bash
composer require hosseinesteki/seo
```

---

## 🛠️ استفاده

### 1. Meta Manager
```php
SEO::meta()->setTitle('صفحه مقاله');
SEO::meta()->setDescription('توضیحات مقاله');
SEO::meta()->setKeywords(['Laravel', 'SEO']);
SEO::meta()->setCanonical(route('articles.show', $article));
```

### 2. Schema Generator
```php
$schema = SEO::schema($article);
{!! $schema !!}
```

### 3. Sitemap Generator
```bash
php artisan seo:generate-sitemap
```
خروجی: `public/sitemap.xml`

### 4. Redirects
```php
SEO::addRedirect('/old-page', '/new-page', 301);
```

---

## 📄 مدل‌ها و مایگریشن‌ها
### Organization
مدل و جدول برای ذخیره اطلاعات سازمان/شرکت:
- name
- website
- logo_url
- phone
- social_links

### Article, Product, Category, Tag
مدل‌های محتوایی که به صورت داینامیک وارد Sitemap و Schema می‌شوند.

---

## 📌 Scheduler
برای اجرای خودکار Sitemap Generator، در ServiceProvider ماژول اضافه شده است:
```php
$this->app->booted(function () {
    $schedule = $this->app->make(\Illuminate\Console\Scheduling\Schedule::class);
    $schedule->command('seo:generate-sitemap')->daily();
});
```

---

## 🎯 نتیجه
با این ماژول می‌توانید:
- متاتگ‌ها و اسکیما را به صورت خودکار مدیریت کنید.
- Sitemap داینامیک بسازید.
- Redirectها را کنترل کنید.
- همه‌ی این قابلیت‌ها را از طریق Facade `SEO` در دسترس داشته باشید.

