<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Exceptions\DecoderException;

class ImageWatermarkService
{
    public function addWatermark($imagePath, $watermarkImagePath = 'images/watermarks/watermark.png', $opacity = 50)
    {
        try {
            // Ensure opacity is between 0 and 100
            $opacity = max(0, min(100, $opacity));

            // Remove 'public/' from the path if it exists since public_path() already includes it
            $imagePath = str_replace('public/', '', $imagePath);
            $watermarkImagePath = str_replace('public/', '', $watermarkImagePath);

            // Ensure the paths are correct for public/storage
            $absolutePath = public_path($imagePath);
            $watermarkAbsolutePath = public_path($watermarkImagePath);

            // Check if files exist
            if (!file_exists($absolutePath)) {
                throw new \Exception("Image file not found at path: {$absolutePath}");
            }
            if (!file_exists($watermarkAbsolutePath)) {
                throw new \Exception("Watermark image not found at path: {$watermarkAbsolutePath}");
            }

            // Create image manager with desired driver
            $manager = new ImageManager(new Driver());

            // Load the main image
            $img = $manager->read($absolutePath);

            // Load the watermark image
            $watermark = $manager->read($watermarkAbsolutePath);

            // Calculate watermark size (15% of the smaller dimension of the main image)
            $watermarkSize = min($img->width(), $img->height()) * 0.15;

            // Resize watermark while maintaining aspect ratio
            $watermark->resize($watermarkSize, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            // Place the watermark in the center with opacity
            $positions = [
                'top-left',
                'top-center',
                'top-right',
                'center-left',
                'center',
                'center-right',
                'bottom-left',
                'bottom-center',
                'bottom-right',
            ];

            $randomPosition = $positions[array_rand($positions)];
            $img->place(
                $watermark,
                $randomPosition,
                90,
                50,
                80 // Increase opacity (80 = 80% opaque, 20% transparent)
            );


            // Save the watermarked image
            $img->save($absolutePath);

            return $imagePath;
        } catch (DecoderException $e) {
            throw new \Exception("Unable to process image: " . $e->getMessage());
        } catch (\Exception $e) {
            throw new \Exception("Error adding watermark: " . $e->getMessage());
        }
    }
}
