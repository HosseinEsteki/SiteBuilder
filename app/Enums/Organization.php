<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum Organization: string
{
    const Main = 'main';
    const Social = 'social';

    public static function Values(){
        return \App\Models\Organization::query()->groupBy('category')->get();
    }
    public function getValues(): Collection
    {
        return \App\Models\Organization::query()->where('category', $this->value)->pluck('value', 'key');
    }

    public function label()
    {
        return trans('organization.category.'.$this->value);
    }
    public static function setValue($key, $value): void
    {
        \App\Models\Organization::query()->where('key', $key)->update(['value' => $value]);
    }
}
