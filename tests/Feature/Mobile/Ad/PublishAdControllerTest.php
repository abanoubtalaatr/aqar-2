<?php

namespace Tests\Feature\Mobile\Ad;

use App\Models\Ad;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PublishAdControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     */
    public function test_publish_at_for_ad_successfully(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $ad = Ad::factory()->create();

        $this->postJson("api/m/real-estates/$ad->id/publish")
        ->assertOk();

        $this->assertDatabaseHas('ads', [
           'published_at' => now()
        ]);

    }
}
