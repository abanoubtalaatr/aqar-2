<?php

namespace Tests\Feature\Mobile\Ad;

use App\Models\Ad;
use Tests\TestCase;
use App\Models\File as FileModel;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;

class FileAdvertisementControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test successful upload assets to ad.
     *
     * @return void
     */
    public function test_upload_assets_for_ad_successfully()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $ad = Ad::factory()->create();

        $file = UploadedFile::fake()->image('image.jpg');

        $this->postJson("api/m/real-estates/upload-assets/$ad->id", [
            'file' => $file
        ])->assertOk();

        $this->assertDatabaseCount('files', 1);
    }


    public function test_remove_file_from_ad_successfully()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        // Create an ad
        $ad = Ad::factory()->create();

        // Define the path where the file will be stored
        $path = "/var/www/html/Ad/{$ad->id}/image.jpg";

        // Make sure the directory exists
        $directory = dirname($path);
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        // Create a test file at the specified path
        file_put_contents($path, 'Test content');

        // Simulate the file creation in the database
        $file = FileModel::create([
            'path' => "Ad/{$ad->id}/image.jpg", // Use relative path for database
            'type' => 0,
            'ad_id' => $ad->id,
            'description' => 'description',
        ]);

        // Assert the file exists before deletion
        $this->assertTrue(file_exists($path));

        // Make the API request to remove the file
        $response = $this->postJson("api/m/files/{$file->id}/remove");

        // Assert the response is successful
        $response->assertStatus(200);

        // Assert the file no longer exists
        $this->assertFalse(file_exists($path));

        // Assert the file record is deleted from the database
        $this->assertDatabaseMissing('files', ['id' => $file->id]);
    }
}
