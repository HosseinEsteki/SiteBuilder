# 🛒 Ecommerce Module

ماژول **Ecommerce** یک پکیج لاراولی برای مدیریت فروشگاه آنلاین است. این ماژول امکاناتی مثل مدیریت برندها، محصولات، دسته‌بندی‌ها، سبد خرید و گالری تصاویر محصولات را فراهم می‌کند.

---

## 📌 امکانات
- مدیریت **برندها** (Brand) با قابلیت آپلود لوگو
- مدیریت **محصولات** (Product) با گالری تصاویر
- مدیریت **دسته‌بندی‌ها** (Category)
- مدیریت **سبد خرید** (Cart) و آیتم‌های آن (CartItem)
- پشتیبانی از **Spatie Media Library** برای مدیریت فایل‌ها و تصاویر
- API آماده برای عملیات CRUD

---

## 📦 نصب
1. اضافه کردن ماژول به پروژه لاراول:
   ```bash
   composer require hossein/ecommerce
   ```

2. انتشار فایل‌های کانفیگ و مایگریشن:
   ```bash
   php artisan vendor:publish --tag=ecommerce-config
   php artisan migrate
   ```

3. اضافه کردن ServiceProvider در `config/app.php` (اگر auto-discovery فعال نیست):
   ```php
   Hossein\Ecommerce\EcommerceServiceProvider::class,
   ```

---

## ⚙️ تنظیمات
- مسیرهای ماژول در فایل `routes/web.php` و `routes/api.php` قرار دارند.
- برای فعال شدن CSRF Token باید routeها داخل گروه `web` قرار بگیرند:
  ```php
  Route::middleware('web')->group(function () {
      Route::resource('brands', BrandController::class);
      Route::resource('products', ProductController::class);
      Route::resource('categories', CategoryController::class);
      Route::resource('cart', CartController::class);
  });
  ```

---

## 🖼️ مدیریت تصاویر
- برندها: یک لوگو در کالکشن `logo`
- محصولات: چند تصویر در کالکشن `gallery`

نمونه ذخیره تصویر محصول:
```php
$product->addMedia($request->file('image'))->toMediaCollection('gallery');
```

---

## 🛒 سبد خرید
برای لود کردن cart همراه با آیتم‌ها و محصولات:
```php
$cart = Cart::with('items.product')->findOrFail($id);
```

---

## 📌 API نمونه
### ایجاد برند
```http
POST /brands
Content-Type: multipart/form-data

name=Apple
slug=apple
logo=@apple.png
```

### ایجاد محصول با گالری
```http
POST /products
Content-Type: multipart/form-data

name=MacBook Pro
slug=macbook-pro
price=2000
stock=5
brand_id=1
category_id=2
gallery[]=@image1.jpg
gallery[]=@image2.png
```

---

## 📌 توسعه
- برای افزودن قابلیت جدید، کلاس‌ها در مسیر `Hossein/Ecommerce/Models` و `Hossein/Ecommerce/Http/Controllers` قرار دارند.
- می‌توانی Requestهای اختصاصی برای اعتبارسنجی بسازی (مثل `ProductStoreRequest`, `BrandUpdateRequest`).
- برای مدیریت فایل‌ها از **Spatie Media Library** استفاده می‌شود.

---
