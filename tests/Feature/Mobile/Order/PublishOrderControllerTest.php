<?php

namespace Tests\Feature\Mobile\Order;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PublishOrderControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test publish order successfully
     */
    public function test_publish_order_successfully(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $order = Order::factory()->create();

        $this->postJson('api/m/orders/' . $order->id . '/publish')->assertOk();

        $this->assertDatabaseHas('orders', [
            'published_at' => now(),
        ]);
    }
}
