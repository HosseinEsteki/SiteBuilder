<?php

namespace Seo\Schemas;

use Spatie\SchemaOrg\Schema;

class OrganizationSchema
{
    public static function generate($organization): string
    {
        return Schema::organization()
            ->name($organization->name)
            ->url($organization->website)
            ->logo($organization->logo_url ?? asset('default-logo.png'))
            ->contactPoint(
                Schema::contactPoint()
                    ->telephone($organization->phone)
                    ->contactType('customer service')
            )
            ->sameAs($organization->social_links ?? [])
            ->toScript();
    }
}
