<?php

namespace Ecommerce\Services;

use Carbon\Carbon;
use Ecommerce\Models\Coupon;
use Ecommerce\Models\Discount;

class DiscountService
{
    /**
     * بررسی و اعمال تخفیف‌ها روی سبد خرید
     */
    public function applyDiscounts($cart, $couponCode = null)
    {
        $total = $cart->total(); // مجموع قیمت سبد خرید
        $discountAmount = 0;

        // اگر کوپن وارد شده
        if ($couponCode) {
            $coupon = Coupon::where('code', $couponCode)->first();
            if ($coupon && $this->isCouponValid($coupon)) {
                $discountAmount += $this->calculateDiscount($coupon->discount, $cart);
                $coupon->increment('used_count');
            }
        }

        // تخفیف‌های عمومی (بدون کوپن)
        $discounts = Discount::where('active', true)->get();
        foreach ($discounts as $discount) {
            if ($this->isDiscountValid($discount)) {
                $discountAmount += $this->calculateDiscount($discount, $cart);
            }
        }

        return [
            'original_total' => $total,
            'discount' => $discountAmount,
            'final_total' => max(0, $total - $discountAmount),
        ];
    }

    /**
     * بررسی اعتبار تخفیف
     */
    private function isDiscountValid(Discount $discount)
    {
        $now = Carbon::now();
        if ($discount->start_date && $discount->start_date > $now) return false;
        if ($discount->end_date && $discount->end_date < $now) return false;
        if ($discount->usage_limit && $discount->used_count >= $discount->usage_limit) return false;
        return true;
    }

    /**
     * بررسی اعتبار کوپن
     */
    private function isCouponValid(Coupon $coupon)
    {
        if ($coupon->usage_limit && $coupon->used_count >= $coupon->usage_limit) return false;
        return $this->isDiscountValid($coupon->discount);
    }

    private function calculateConditionalDiscount(Discount $discount, $cart)
    {
        $conditions = json_decode($discount->conditions, true);

        // مثال: اگر مجموع خرید بالای 500 هزار باشه، 10٪ تخفیف بده
        if (isset($conditions['min_total']) && $cart->total() >= $conditions['min_total']) {
            return $cart->total() * ($discount->value / 100);
        }

        // مثال: اگر تعداد آیتم‌ها بیشتر از 3 باشه، مبلغ ثابت کم کن
        if (isset($conditions['min_items']) && $cart->itemsCount() >= $conditions['min_items']) {
            return $discount->value;
        }

        return 0;
    }

    /**
     * محاسبه مقدار تخفیف
     */
    private function calculateDiscount(Discount $discount, $cart)
    {
        switch ($discount->type) {
            case 'percentage':
                return $cart->total() * ($discount->value / 100);

            case 'fixed':
                return $discount->value;

            case 'free_shipping':
                return $cart->shipping_cost;

            case 'conditional':
                return $this->calculateConditionalDiscount($discount, $cart);

            default:
                return 0;
        }
    }


}
