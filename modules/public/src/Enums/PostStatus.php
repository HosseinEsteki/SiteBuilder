<?php

namespace Public\Enums;

enum PostStatus: string
{
    case Published = 'published';
    case Draft = "draft";
    case Archived = "archived";

    public static function getNames(): array
    {
        return array_column(self::cases(), 'name');
    }

    public function label()
    {
        return match ($this) {
            self::Draft => trans('public.postStatus.draft'),
            self::Published => trans('public.postStatus.published'),
            self::Archived => trans('public.postStatus.archived')
        };
    }
    private static function getPostStatusByValue($value)
    {
        $result = collect(self::cases())->where('value', $value)->first();
        return $result;
    }

    public static function showState($state)
    {
        $postStatus = self::getPostStatusByValue($state);
        return $postStatus->label();
    }
    public static function options(): array
    {
        $options = [];

        foreach (self::cases() as $case) {
            $options[$case->name] = $case->label();
        }

        return $options;
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::Published => 'success',
            self::Draft => 'danger',
            self::Archived => 'info',
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

}
