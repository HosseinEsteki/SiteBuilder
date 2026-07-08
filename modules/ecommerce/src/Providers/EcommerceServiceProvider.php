<?php
namespace Ecommerce\Providers;

use Ecommerce\Enums\OrderStatus;
use Ecommerce\Models\Order;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use IRPayment\Events\PaymentCanceled;
use IRPayment\Events\PaymentFailed;
use IRPayment\Events\PaymentVerified;
use IRPayment\Models\Payment;

class EcommerceServiceProvider extends ServiceProvider
{
    public function register()
    {
        // اینجا می‌تونی سرویس‌ها و ریپازیتوری‌ها رو bind کنی
    }

    public function boot(): void
    {
        // بارگذاری Route ها
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        // بارگذاری مایگریشن‌ها
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');

        // بارگذاری ویوها (اگر داشتی)
        $viewsPath = __DIR__.'/../resources/views';
        if (is_dir($viewsPath)) {
            $this->loadViewsFrom($viewsPath, 'ecommerce');
        }

        // بارگذاری کانفیگ‌ها
        $this->mergeConfigFrom(__DIR__.'/../config/tags.php', 'tags');
        $this->mergeConfigFrom(__DIR__.'/../config/media-library.php', 'media-library');
        $this->mergeConfigFrom(__DIR__.'/../config/money.php', 'money');

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'ecommerce');
        $this->listenForPaymentEvents();

    }

    protected function listenForPaymentEvents(): void
    {
        Event::listen(PaymentVerified::class, function (PaymentVerified $event): void {
            $this->updateOrderFromPayment($event->payment, OrderStatus::Paid->value, $event->verification->referenceId);
        });

        Event::listen(PaymentFailed::class, function (PaymentFailed $event): void {
            $this->updateOrderFromPayment($event->payment, OrderStatus::Failed->value);
        });

        Event::listen(PaymentCanceled::class, function (PaymentCanceled $event): void {
            $this->updateOrderFromPayment($event->payment, OrderStatus::Cancelled->value);
        });
    }

    protected function updateOrderFromPayment(Payment $payment, string $status, int|string|null $paymentRef = null): void
    {
        $order = $payment->paymentable;

        if (! $order instanceof Order) {
            return;
        }

        $order->update([
            'status' => $status,
            'payment_ref' => $paymentRef ?: $payment->reference_id ?: $payment->authority_key,
        ]);
    }
}
