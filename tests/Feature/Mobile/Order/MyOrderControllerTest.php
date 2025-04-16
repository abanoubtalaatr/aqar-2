<?php

namespace Tests\Feature\Mobile\Order;

use App\Models\Order;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MyOrderControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A test get my orders successfully.
     */
    public function test_test_get_orders_successfully(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $orders = Order::factory()->count(5)->create(['user_id' => $user->id]);

        $this->getJson('/api/m/my-orders')->assertOk();

        $this->assertCount(5, $orders);

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id
        ]);
    }

    /**
    * A test show my orders details successfully.
    */
    public function test_get_show_details_of_my_order_successfully()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $order = Order::factory()->create(['user_id' => $user->id]);

        $this->getJson('/api/m/my-orders/' . $order->id)->assertOk();

    }

    /**
    * A test can not show my order details successfully.
    */
    public function test_can_not_get_show_details_of_my_order_successfully()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $order = Order::factory()->create();

        $this->getJson('/api/m/my-orders/' . $order->id)->assertStatus(403);
    }

    /**
    * A test delete my orders successfully.
    */
    public function test_delete_my_order_successfully()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $order = Order::factory()->create(['user_id' => $user->id]);

        $this->deleteJson('/api/m/my-orders/' . $order->id)->assertOk();

    }

    /**
    * A test delete can not delete orders not belongs to user successfully.
    */
    public function test_can_not_delete_orders_not_belongs_to_user_successfully()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $order = Order::factory()->create();

        $this->deleteJson('/api/m/my-orders/' . $order->id)->assertStatus(403);
    }
}
