<?php

namespace Tests\Feature\Mobile\Order\Sell\Add;

use App\Models\Category;
use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LandTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * test add land order.
     */
    public function test_add_land_order(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $category = Category::factory()->create([
            'id' => 2,
            'adable' => "App\Models\Land",
        ]);

        $data = Order::factory()->make([
            'user_id' => $user->id,
            'adable_id' => $category->id,
            'adable_type' => $category->adable,
            'for_rent' => '0',
            'category_id' => $category->id
            ])->toArray();

        $this->postJson('api/m/orders', $data)->assertOk();

        $this->assertDatabaseCount('orders', 1);

        $this->assertDatabaseCount('lands', 1);
    }
}
