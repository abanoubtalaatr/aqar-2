<?php

namespace Tests\Feature\Mobile\Order\Rent\Update;

use App\Models\Category;
use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExhibitionTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * test update exhibition order.
     */
    public function test_update_exhibition_order(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $category = Category::factory()->create([
            'id' => 22,
            'adable' => "App\Models\Exhibition",
        ]);

        $order = Order::factory()->create(['user_id' => $user->id]);

        $data = Order::factory()->make([
            'user_id' => $user->id,
            'adable_id' => $category->id,
            'adable_type' => $category->adable,
            'for_rent' => '1',
            'category_id' => $category->id
            ])->toArray();

        $this->putJson('api/m/orders/'. $order->id, $data)->assertOk();

        $this->assertDatabaseCount('orders', 1);

        $this->assertDatabaseCount('exhibitions', 1);
    }
}
