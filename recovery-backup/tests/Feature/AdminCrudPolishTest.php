<?php

namespace Tests\Feature;

use Ecommerce\Enums\OrderStatus;
use Public\Enums\CommentStatus;
use Tests\TestCase;

class AdminCrudPolishTest extends TestCase
{
    public function test_admin_order_status_options_use_database_values(): void
    {
        $this->assertArrayHasKey(OrderStatus::Pending->value, OrderStatus::options());
        $this->assertArrayHasKey(OrderStatus::Paid->value, OrderStatus::options());
        $this->assertArrayNotHasKey(OrderStatus::Pending->name, OrderStatus::options());
    }

    public function test_admin_comment_status_options_use_database_values(): void
    {
        $this->assertArrayHasKey(CommentStatus::Pending->value, CommentStatus::options());
        $this->assertArrayHasKey(CommentStatus::Approved->value, CommentStatus::options());
        $this->assertArrayNotHasKey(CommentStatus::Pending->name, CommentStatus::options());
    }
}
