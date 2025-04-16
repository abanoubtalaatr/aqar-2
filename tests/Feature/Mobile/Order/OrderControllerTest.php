<?php

namespace Tests\Feature\Mobile\Order;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * get orders successfully.
     */

    public function test_get_all_orders(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $orders = Order::factory()->count(5)->create();

        $this->getJson('api/m/orders')->assertOk();

        $this->assertCount(5, $orders);
    }
}
