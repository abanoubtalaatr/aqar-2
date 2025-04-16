<?php

namespace Tests\Feature\Mobile\Order;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChangePublishedAtControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test change published at for order successfully.
     */
    public function test_change_published_at_for_order_successfully(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $order = Order::factory()->create(['published_at' => now()->subDay()]);

        $this->postJson("api/m/orders/$order->id/change-published-at")->assertOk();

        $this->assertDatabaseHas('orders', [
            'published_at' => now(),
        ]);
    }
}
