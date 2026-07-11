<?php

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Spatie\Permission\PermissionRegistrar;
use Theme\Database\Seeders\ThemePermissionSeeder;
use Theme\Models\ThemePage;

it('shows a published theme page', function () {
    ThemePage::query()->create([
        'title' => 'Published Page',
        'slug' => 'published-page',
        'builder_data' => [
            [
                'type' => 'heading',
                'settings' => [
                    'text' => 'Published Theme Heading',
                    'level' => 'h1',
                ],
            ],
        ],
        'meta_title' => 'Custom Meta Title',
        'meta_description' => 'Custom meta description.',
        'status' => 'published',
        'published_at' => now(),
    ]);

    $this->get('/pages/published-page')
        ->assertOk()
        ->assertSee('Published Theme Heading')
        ->assertSee('<title>Custom Meta Title</title>', false)
        ->assertSee('Custom meta description.');
});

it('does not show a draft theme page publicly', function () {
    ThemePage::query()->create([
        'title' => 'Draft Page',
        'slug' => 'draft-page',
        'builder_data' => [
            [
                'type' => 'heading',
                'settings' => [
                    'text' => 'Draft Heading',
                ],
            ],
        ],
        'status' => 'draft',
    ]);

    $this->get('/pages/draft-page')->assertNotFound();
});

it('returns not found for unknown theme page slugs', function () {
    $this->get('/pages/missing-page')->assertNotFound();
});

it('does not allow guests to preview draft theme pages', function () {
    $page = ThemePage::query()->create([
        'title' => 'Preview Draft',
        'slug' => 'preview-draft',
        'builder_data' => [
            [
                'type' => 'text',
                'settings' => [
                    'text' => 'Guest should not see this draft.',
                ],
            ],
        ],
        'status' => 'draft',
    ]);

    $this->get("/admin/theme/pages/{$page->id}/preview")
        ->assertRedirect('/login');
});

it('allows authenticated users to preview draft theme pages', function () {
    app(ThemePermissionSeeder::class)->run();
    app(RoleSeeder::class)->run();
    app(PermissionRegistrar::class)->forgetCachedPermissions();

    $user = User::factory()->create();
    $user->assignRole('Editor');

    $page = ThemePage::query()->create([
        'title' => 'Preview Draft',
        'slug' => 'preview-draft',
        'builder_data' => [
            [
                'type' => 'text',
                'settings' => [
                    'text' => 'Authenticated preview content.',
                ],
            ],
        ],
        'status' => 'draft',
    ]);

    $this->actingAs($user)
        ->get("/admin/theme/pages/{$page->id}/preview")
        ->assertOk()
        ->assertSee('Authenticated preview content.');
});
