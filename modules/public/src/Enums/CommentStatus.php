<?php

namespace Public\Enums;

enum CommentStatus: string
{
    case Pending = 'pending';
    case Approved ='approved';
    case Rejected ='rejected';
    case Hidden = 'hidden';
    public function label(): string{
        return match ($this) {
            self::Pending=>trans('public.comments.status.pending'),
            self::Approved=>trans('public.comments.status.approved'),
            self::Rejected=>trans('public.comments.status.rejected'),
            self::Hidden=>trans('public.comments.status.hidden'),
        };
    }
    public function color(): string
    {
        return match ($this) {
            self::Approved=>'success' ,
            self::Rejected=>'danger',
            self::Pending=>'warning',
            self::Hidden=>'gray',
        };
    }

    public static function options()
    {
        return collect(static::cases())->mapWithKeys(function ($item) {
            return [$item->name => $item->label()];
        })->toArray();
    }

    public static function values(): array
    {
        return collect(static::cases())->pluck('value')->toArray();
    }

    public static function filamentColors():array
    {
        $colors = [];
        foreach (static::cases() as $status) {
            $colors[$status->color()]=$status->value;
        }
        return $colors;
    }
}
