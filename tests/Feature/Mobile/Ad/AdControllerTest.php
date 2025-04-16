<?php

namespace Tests\Feature\Mobile\Ad;

use App\Models\Ad;
use Tests\TestCase;
use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Delete ad successfully.
     */
    public function test_delete_ad_successfully(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $adable = Room::factory()->create();

        $ad = Ad::factory()->create(['adable_id' => $adable->id, 'adable_type' => get_class($adable)]);

        $this->deleteJson("api/m/real-estates/$ad->id/delete")->assertOk();


        $this->assertDatabaseCount('ads', 0);
        $this->assertDatabaseCount('rooms', 0);
    }
}
