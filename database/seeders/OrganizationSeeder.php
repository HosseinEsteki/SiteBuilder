<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organization::query()->create([
            'name'=>'فروشگاه کفش کفشولو',
            'website'=>'https://kafshooloo.ir',
            'phone'=>'09131234568',
            'social_links'=>json_encode([
                'instagram'=>'https://instagram.com/kafshooloo',
                'youtube'=>'https://youtube.com/kafshooloo',
                'telegram'=>'https://telegram.me/kafshooloo',
            ]),
        ]);
    }
}
