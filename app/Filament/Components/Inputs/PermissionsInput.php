<?php
namespace App\Filament\Components\Inputs;

use App\Helpers\PermissionHelper;
use App\Models\Authorize\Permission;
use Filament\Forms\Components\CheckboxList;
use Filament\Schemas\Components\Fieldset;
use Spatie\Permission\Models\Role;

class PermissionsInput
{
    public static function make()
    {
        // ساختار permissionها:
        // module → [ name => label ]
        $modulesMap = PermissionHelper::buildModulesMap();

        // parent → [children...]
        $parentChildMap = PermissionHelper::buildParentChildMap();

        return Fieldset::make(trans('permissions.permissions'))
            ->schema(function (callable $get, $record) use ($modulesMap, $parentChildMap) {

                $checkBoxes = [];
                $modules = array_keys($modulesMap);

                foreach ($modulesMap as $moduleName => $moduleFields) {


                    $checkBoxes[] = CheckboxList::make($moduleName)
                        ->reactive()
                        ->label(trans("{$moduleName}::permissions.{$moduleName}"))
                        /**
                         * options:
                         * key = name (انگلیسی)
                         * value = label (فارسی)
                         */
                        ->options($moduleFields)
                        /**
                         * مقداردهی اولیه در حالت ویرایش
                         */
                        ->afterStateHydrated(function ($set, $state, $record) use ($moduleName) {
                            $moduleDefaults = collect(PermissionHelper::buildModulesMap($record, $moduleName)[$moduleName] ?? null);
                            $set($moduleName, $moduleDefaults->mapWithKeys(function ($item, $key) {
                                return [$item => $key];
                            }));
                        })
//                            $result=$role->permissions()->sync(Permission::query()->whereIn('name', $state)->pluck('id')->toArray());
                        ->dehydrateStateUsing(function ($state, callable $get, Role $role) use ($modules) {
                            $array = [];
                            foreach ($modules as $module) {
                                $array = array_merge($array, $get($module));
                            }
                            $role->permissions()->sync(Permission::query()->whereIn('name', $array)->pluck('id')->toArray() ?? null);
                        })
                        ->columns(2)
                        /**
                         * کنترل فعال/غیرفعال بودن گزینه‌ها
                         */
                        ->disableOptionWhen(function ($value, $state) use ($parentChildMap, $moduleName) {

                            // 1) خود ماژول همیشه فعال است
                            if ($value === $moduleName) {
                                return false;
                            }

                            // 2) اگر ماژول تیک نخورده → parent و child disabled
                            if (!in_array($moduleName, $state)) {
                                return true;
                            }

                            // 3) اگر parent تیک نخورده → child disabled
                            foreach ($parentChildMap as $parent => $children) {

                                // فقط parentهای همین ماژول
                                if (!str_starts_with($parent, $moduleName . '.')) {
                                    continue;
                                }

                                // اگر این گزینه child باشد
                                if (in_array($value, $children)) {
                                    // اگر parent تیک نخورده → child disabled
                                    return !in_array($parent, $state);
                                }
                            }

                            return false;
                        })
                        /**
                         * رفتار reactive:
                         * اگر parent تیک خورد → children فعال شوند
                         * اگر parent برداشته شد → children حذف شوند
                         */
                        ->afterStateUpdated(function ($state, callable $set) use ($parentChildMap, $moduleName) {

                            // اگر ماژول تیک خورده باشد
                            if (in_array($moduleName, $state)) {

                                foreach ($parentChildMap as $parent => $children) {

                                    // فقط parentهای همین ماژول
                                    if (!str_starts_with($parent, $moduleName . '.')) {
                                        continue;
                                    }

                                    // اگر parent تیک نخورده → children حذف شوند
                                    if (!in_array($parent, $state)) {
                                        $state = array_unique(array_diff($state, $children));
                                    }
                                }
                            } else
                                $state = [];

                            // ذخیره state جدید
                            $set($moduleName, $state);
                        });
                }

                return $checkBoxes;
            })
            ->columnSpanFull()
            ->columns(2);
    }

}
