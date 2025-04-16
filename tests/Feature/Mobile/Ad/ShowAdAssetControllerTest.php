<?php

namespace Tests\Feature\Mobile\Ad;

use App\Models\Ad;
use Tests\TestCase;
use App\Models\User;

class ShowAdAssetControllerTest extends TestCase
{
    /**
     * Show assets for ad.
     */
    public function test_show_assets_for_ad(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $ad = Ad::factory()->create();

        $this->getJson("api/m/real-estates/$ad->id/assets")->assertOk();
    }
}
