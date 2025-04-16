<?php

namespace Tests\Feature\Mobile\MyAd;

use App\Models\Ad;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MyRealEstatesControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A test get my real estates successfully.
     */
    public function test_test_get_my_real_estates_successfully(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $ads = Ad::factory()->count(5)->create(['user_id' => $user->id]);

        $this->getJson('/api/m/my-real-estates')->assertOk();

        $this->assertCount(5, $ads);

        $this->assertDatabaseHas('ads', [
            'user_id' => $user->id
        ]);
    }

    /**
    * A test show my real estates details successfully.
    */
    public function test_get_show_details_of_my_ad_successfully()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $ad = Ad::factory()->create(['user_id' => $user->id]);

        $this->getJson('/api/m/my-real-estates/' . $ad->id)->assertOk();
    }

    /**
    * A test can not show my real estates details successfully.
    */
    public function test_can_not_get_show_details_of_my_ad_successfully()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $ad = Ad::factory()->create();

        $this->getJson('/api/m/my-real-estates/' . $ad->id)->assertStatus(403);
    }

    /**
    * A test delete my real estates successfully.
    */
    public function test_delete_my_real_estates_successfully()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $ad = Ad::factory()->create(['user_id' => $user->id]);

        $this->deleteJson('/api/m/my-real-estates/' . $ad->id)->assertOk();
    }

    /**
    * A test delete can not delete real estates not belongs to user successfully.
    */
    public function test_can_not_delete_real_estates_not_belongs_to_user_successfully()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $ad = Ad::factory()->create();

        $this->deleteJson('/api/m/my-real-estates/' . $ad->id)->assertStatus(403);
    }
}
