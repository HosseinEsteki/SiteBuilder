<?php

namespace App\Models\Authorize;

use Illuminate\Database\Eloquent\Casts\Attribute;

class Permission extends \Spatie\Permission\Models\Permission
{
    protected $fillable = ['name', 'guard_name','module'];

    protected function label(): Attribute
    {
        return Attribute::make(
            get: function($value,array $attributes){
                $name = $this->name;
                $module = $attributes['module'] ?? null;
                if (!$module) {
                    return $name;
                }
                return trans("{$module}::permissions.{$this->attributes['name']}");
            },

        );
    }
    protected static function boot()
    {
        parent::boot();
    }


}
