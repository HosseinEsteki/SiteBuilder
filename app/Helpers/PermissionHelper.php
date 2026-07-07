<?php

namespace App\Helpers;

use App\Models\Authorize\Permission;
use Spatie\Permission\Models\Role;

class PermissionHelper
{
    public static function buildPermissionsToArray(?Role $role=null,?string $module=null)
    {
        if(is_null($role)){
            $permissions = Permission::pluck('name')->toArray();
        }
        else {
            $permissions = $role->permissions?->pluck('name')->filter(function ($item) use ($module) {
                return str_starts_with($item, $module);
            });
        }
        $result = [];

        foreach ($permissions as $permission) {

            $parts = explode('.', $permission);

            $module = $parts[0] ?? null;
            $parent = $parts[1] ?? null;
            $child  = $parts[2] ?? null;

            // فقط module
            if (!$parent) {
                $result[$module] = $result[$module] ?? null;
                continue;
            }

            // module.parent
            if (!$child) {
                $result[$module][$parent] = $result[$module][$parent] ?? null;
                continue;
            }

            // module.parent.child
            $result[$module][$parent][] = $child;
        }

        return collect($result);
    }

    public static function buildModulesMap(?Role $role=null,?string $module=null)
    {
        if(is_null($role)){
            $permissions=Permission::all()->pluck('label','name');
        }
        else {
            $permissions = $role->permissions?->pluck('label','name')->filter(function ($item,$key) use ($module) {
                return str_starts_with($key, $module);
            });
        }

        $result=[];
        foreach ($permissions as $name=>$label) {
            $result[explode('.',$name)[0]][$name]=$label;
        }
        return $result;

    }
    public static function buildParentChildMap(): array
    {
        $structure = self::buildPermissionsToArray();
        $map = [];

        foreach ($structure as $module => $parts) {

            if ($parts === null) continue;

            foreach ($parts as $parent => $children) {

                if ($children === null) continue;

                $parentKey = "{$module}.{$parent}";

                $map[$parentKey] = array_map(
                    fn($child) => "{$module}.{$parent}.{$child}",
                    $children
                );
            }
        }

        return $map;
    }

}
