<?php

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Spatie\Permission\PermissionRegistrar;
use Theme\Database\Seeders\ThemePermissionSeeder;
use Theme\Database\Seeders\ThemeSeeder;
use Theme\Models\ThemePage;

beforeEach(function () {
    app(ThemePermissionSeeder::class)->run();
    app(RoleSeeder::class)->run();
    app(PermissionRegistrar::class)->forgetCachedPermissions();
});

it('allows super admin to access theme resources', function () {
    $user = User::factory()->create();
    $user->assignRole('Super Admin');

    $this->actingAs($user)
        ->get('/admin/theme-builder/themes')
        ->assertOk();

    $this->actingAs($user)
        ->get('/admin/theme-builder/templates/theme-templates')
        ->assertOk();

    $this->actingAs($user)
        ->get('/admin/theme-builder/pages/theme-pages')
        ->assertOk();
});

it('allows editor to manage allowed theme pages', function () {
    $user = User::factory()->create();
    $user->assignRole('Editor');

    $page = ThemePage::query()->create([
        'title' => 'Editor Draft',
        'slug' => 'editor-draft',
        'builder_data' => [
            [
                'type' => 'heading',
                'settings' => ['text' => 'Editor Draft'],
            ],
        ],
        'status' => 'draft',
    ]);

    $this->actingAs($user)
        ->get('/admin/theme-builder/pages/theme-pages')
        ->assertOk();

    $this->actingAs($user)
        ->get('/admin/theme-builder/pages/theme-pages/create')
        ->assertOk();

    $this->actingAs($user)
        ->get("/admin/theme-builder/pages/theme-pages/{$page->id}/edit")
        ->assertOk();

    $this->actingAs($user)
        ->get('/admin/theme-builder/templates/theme-templates')
        ->assertOk();
});

it('prevents customer from accessing theme builder admin pages', function () {
    $user = User::factory()->create();
    $user->assignRole('Customer');

    $this->actingAs($user)
        ->get('/admin/theme-builder/pages/theme-pages')
        ->assertForbidden();
});

it('prevents guests from accessing admin preview', function () {
    $page = ThemePage::query()->create([
        'title' => 'Guest Preview Draft',
        'slug' => 'guest-preview-draft',
        'builder_data' => [
            [
                'type' => 'text',
                'settings' => ['text' => 'Hidden draft preview.'],
            ],
        ],
        'status' => 'draft',
    ]);

    $this->get("/admin/theme/pages/{$page->id}/preview")
        ->assertRedirect('/login');
});

it('renders the seeded published home page', function () {
    app(ThemeSeeder::class)->run();

    $this->get('/pages/home')
        ->assertOk()
        ->assertSee('Welcome to SiteBuilder')
        ->assertSee('Open admin');
});
