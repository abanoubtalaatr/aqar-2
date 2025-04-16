<?php

namespace App\Services;

use App\Models\Ad;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class RandomImageForAdService
{
    public function generate(Ad $ad)
    {
        // Randomly pick a number between 1 and 15 for the image file
        $randomNumber = rand(1, 15);
        $imagePath = public_path("default/{$randomNumber}.jpeg");

        // Check if the file exists
        if (!file_exists($imagePath)) {
            throw new \Exception("Image not found: {$imagePath}");
        }

        // Read the image file
        $imageContent = file_get_contents($imagePath);

        // Define the path where the image will be uploaded (e.g., in the 'ads' directory)
        $uploadedImagePath = "Ad/{$ad->id}/{$randomNumber}.jpeg";

        // Store the image in the storage/app/public directory
        Storage::disk('public')->put($uploadedImagePath, $imageContent);

        // Save the file information in the database
        File::create([
            'path' => 'public/storage/'. $uploadedImagePath,
            'description' => "Random Ad Image {$randomNumber}",
            'ad_id' => $ad->id,
            'type' => 1000, // this for random image
        ]);

        // Return the uploaded image path
        return $uploadedImagePath;
    }
}
