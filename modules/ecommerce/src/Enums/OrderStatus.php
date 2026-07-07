<?php

namespace Ecommerce\Enums;

enum OrderStatus: string
{
    case Pending = 'pending';
    case Processing = 'processing';
    case Paid = 'paid';
    case Shipped = 'shipped';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    /**
     * نمایش وضعیت با استفاده از فایل‌های ترجمه
     */
    public function label(): string
    {
        return trans('ecommerce::ecommerce.orders.status.' . $this->value);
    }

    private static function getPostStatusByValue($value)
    {
        $result = collect(self::cases())->where('value', $value)->first();
        return $result;
    }

    public static function showState($state)
    {
        return static::getPostStatusByValue($state)->label();
    }

    public static function options()
    {
        return collect(static::cases())->mapWithKeys(function ($item) {
            return [$item->name => $item->label()];
        })->toArray();
    }
    public function badgeColor(): string
    {
        //TODO:: بعدا رنگارو باید عوض کنیم.
        return match ($this) {
            self::Pending => 'info',
            self::Processing => 'warning',
            self::Paid => 'success',
            self::Shipped => 'secondary',
            self::Completed => 'dark',
            self::Cancelled => 'danger',
            default => 'dark',
        };
    }
    public static function filamentColors()
    {
        $colors = [];
        foreach (self::cases() as $case) {
            $colors[$case->badgeColor()]=$case->value;
        }
        return $colors;
    }

    public static function values(): array
    {
        return collect(self::cases())->pluck('value')->toArray();
    }
}
