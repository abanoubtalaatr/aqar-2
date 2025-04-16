<?php

namespace Tests\Feature\Mobile\Order\Sell\Add;

use App\Models\Category;
use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RestTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * test add rest order.
     */
    public function test_add_rest_order(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $category = Category::factory()->create([
            'id' => 9,
            'adable' => "App\Models\Rest",
        ]);

        $data = Order::factory()->make([
            'user_id' => $user->id,
            'adable_id' => $category->id,
            'adable_type' => $category->adable,
            'for_rent' => '0',
            'category_id' => $category->id,
            'number_of_rooms' => $this->faker->numberBetween(1, 10),
            'number_of_bathrooms' => $this->faker->numberBetween(1, 10),
            ])->toArray();

        $this->postJson('api/m/orders', $data)->assertOk();

        $this->assertDatabaseCount('orders', 1);

        $this->assertDatabaseCount('rests', 1);
    }
}
