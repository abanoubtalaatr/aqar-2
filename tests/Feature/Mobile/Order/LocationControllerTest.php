<?php

namespace Tests\Feature\Mobile\Order;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LocationControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test add location to an order.
     */
    public function test_add_location_to_order_successfully(): void
    {
        $user = User::factory()->create();

        $order = Order::factory()->create();

        $this->actingAs($user, 'api');

        $data = [
            'map_latitude' => $this->faker->latitude,
            'map_longitude' => $this->faker->longitude,
        ];

        $this->postJson("api/m/orders/$order->id/location", $data)->assertOk();

        $this->assertDatabaseHas('orders', [
            'map_latitude' => $data['map_latitude'],
            'map_longitude' => $data['map_longitude'],
        ]);
    }
}
