<?php

namespace Ecommerce\Enums;

enum DiscountType: string
{
    case Percentage = 'percentage';
    case Fixed = 'fixed';
    case FreeShipping = 'free_shipping';
    case Conditional = 'conditional';

    public function label()
    {
        return trans('ecommerce::ecommerce.discount.discountType.'.$this->value);
    }

    public static function getLabel($name)
    {
        return static::from($name)->label();
    }
    public static function getNames()
    {
        return collect(self::cases())->pluck('name')->toArray();
    }
    public static function getValues()
    {
        return collect(self::cases())->pluck('value')->toArray();
    }

    public static function options()
    {

        $items=collect(self::cases())->mapWithKeys(function ($value, $key) {
            return [$value->value=>$value->label()];
        });
        return $items;
    }

    public static function filamentColors()
    {
        $colors = [];
        foreach (self::cases() as $case) {
            $colors[$case->badgeColor()]=$case->value;
        }
        return $colors;
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::Percentage => 'primary',
            self::Fixed => 'secondary',
            self::FreeShipping => 'info',
            self::Conditional => 'warning',
            default => 'dark',
        };
    }
}
