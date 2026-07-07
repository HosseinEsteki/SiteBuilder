<?php

namespace Database\Seeders;

use App\Enums\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'name', 'value' => 'فروشگاه کفش کفشولو','category'=>'main'],
            ['key' => 'website', 'value' => 'https://kafshooloo.ir','category'=>'main'],
            ['key' => 'phone', 'value' => '09131234568','category'=>'main'],
            ['key' => 'instagram', 'value' => 'https://instagram.com/kafshooloo','category'=>'social'],
            ['key' => 'youtube', 'value' => 'https://youtube.com/kafshooloo','category'=>'social'],
            ['key' => 'telegram', 'value' => 'https://telegram.me/kafshooloo','category'=>'social'],
        ];
        foreach ($settings as $setting){
            \App\Models\Organization::query()->create($setting);
        }

    }
}
