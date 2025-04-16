<?php

namespace Tests\Feature\Mobile\Order\Rent\Update;

use App\Models\Category;
use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApartmentTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * test update apartment order.
     */
    public function test_update_apartment_order(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $category = Category::factory()->create([
            'id' => 1,
            'adable' => "App\Models\Apartment",
        ]);

        $order = Order::factory()->create([
            'user_id' => $user->id,
            'orderable_id' => $category->id,
            'orderable_type' => $category->adable,
        ]);

        $data = Order::factory()->make([
            'user_id' => $user->id,
            'orderable_id' => $category->id,
            'orderable_type' => $category->adable,
            'for_rent' => '1',
            'category_id' => $category->id,
            'street_width' => $this->faker->randomNumber(2),
            'number_of_rooms' => $this->faker->randomNumber(1),
        ])->toArray();

        $this->putJson('api/m/orders/' . $order->id, $data)->assertOk();

        $this->assertDatabaseCount('orders', 1);

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'orderable_id' => $category->id,
            'orderable_type'  => $category->adable,
            'for_rent'  => "1"
        ]);

        $this->assertDatabaseHas('apartments', [
            'street_width' => $data['street_width'],
            'number_of_rooms' => $data['number_of_rooms']
        ]);

        $this->assertDatabaseCount('apartments', 1);
    }
}
