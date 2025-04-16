<?php

namespace Tests\Feature\Mobile\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_profile_data(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $this->getJson('api/m/profile')
            ->assertOk()
            ->assertJsonStructure([
                'status',
                'msg',
                'data' => [
                    'id',
                    'name',
                    'email',
                    'phone',
                    'token',
                    'avatar',
                    'created_at'
                ],
            ]);
    }

    public function test_update_profile_data()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $data = [
            'name' => 'new name',
            'email' => 'new@gmail.com',
        ];

        $response = $this->postJson('api/m/update/profile', $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'new name',
            'email' => 'new@gmail.com',
        ]);
    }

    public function test_update_password()
    {
        $user = User::factory()->create(['password' => 'password']);

        $this->actingAs($user, 'api');

        $data = [
            'old_password' => 'password',
            'new_password' => 'newpassword',
            'new_password_confirmation' => 'newpassword',
        ];

        $this->putJson('api/m/profile/update/password', $data)->assertOk();
    }

    public function test_logout_user()
    {
        $user = User::factory()->create();

        // Generate a JWT token for the user
        $token = auth('api')->login($user);

        // Send the token in the Authorization header
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('api/m/logout');

        $response->assertStatus(200);
    }

    public function test_delete_account()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $this->deleteJson('api/m/delete/account')->assertOk();

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
