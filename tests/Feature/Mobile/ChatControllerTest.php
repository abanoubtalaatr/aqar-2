<?php

namespace Tests\Feature\Mobile;

use App\Models\Ad;
use Tests\TestCase;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Resources\Api\SimpleChatResource;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChatControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test get all users that chat with them
     */
    public function test_get_all_users_that_i_chat_with_them()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        Chat::factory()->count(5)->create(['sender_id' => $user->id]);

        $this->getJson('api/m/chats')
            ->assertOk()
            ->assertJsonStructure([
                'status',
                'msg',
                'data',
            ]);

        $this->assertDatabaseCount('chats', 5);
    }

    /**
     * Test search on my chat
     */
    public function test_search_on_my_chat()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        // Create chats for the user
        $chats = Chat::factory()->count(5)->create(['sender_id' => $user->id]);
        $firstUser = $chats->first()->receiver;
        $search = $firstUser->name;

        // Perform the search
        $response = $this->getJson("api/m/chats?search=$search");

        // Assert the response status and structure
        $response->assertOk()
            ->assertJsonStructure([
                'status',
                'msg',
                'data',
            ]);

        // Get expected data
        $expectedData = SimpleChatResource::collection($chats->where('receiver_id', $firstUser->id))->response()->getData(true);

        // Assert that 'data' matches the expected chat resources
        $this->assertEquals($expectedData['data'], $response->json('data'));
    }

    /**
     * Test get chat details
     */
    public function test_get_chat_details()
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $chat = Chat::factory()->create(['sender_id' => $user->id]);

        $ad = Ad::factory()->create();

        $this->getJson("api/m/chats/$ad->id/$chat->receiver_id" . $chat->id)
            ->assertOk();
    }

    public function test_send_multiple_files_with_message()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        // Create multiple fake image files
        $files = [
            UploadedFile::fake()->image('test-image1.jpg'),
            UploadedFile::fake()->image('test-image2.jpg'),
        ];
        $message = 'Here are some images'; // Your message

        // Send a POST request with the message and multiple files
        $response = $this->postJson('api/m/chats', [
            'message' => $message,
            'files' => $files,
            'receiver_id' => User::factory()->create()->id, // Replace with an actual receiver ID
            'ad_id' => Ad::factory()->create()->id, // Replace with an actual ad ID
        ]);

        // Assert the response
        $response->assertStatus(200)

        ;
    }
    /**
     * Test send successfully message
     */
    public function test_send_successfully_message(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $data = [
            'receiver_id' => User::factory()->create()->id,
            'message' => $this->faker->sentence(),
            'ad_id' => Ad::factory()->create()->id
        ];

        $this->postJson('api/m/chats', $data)->assertOk();
    }

    /**
     * Test can not send message with missing one require data
     */
    public function test_can_not_send_message_with_missing_data(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api');

        $data = [
            'receiver_id' => User::factory()->create()->id,
            'message' => $this->faker->sentence(),
        ];

        $this->postJson('api/m/chats', $data)
            ->assertStatus(400)
            ->assertJsonStructure([
                'status',
                'msg',
                'is_verify',
            ])->assertJson([
                'msg' => __('mobile.Ad id is required'),
                'is_verify' => true,
                'status' => false,
            ]);
    }
}
