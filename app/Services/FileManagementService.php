<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

trait FileManagementService
{
    public function upload_base64($base64Image, $model)
    {
        $folderPath = storage_path('app/public/' . $model . '/');

        // Ensure the directory exists, if not, create it
        if (! file_exists($folderPath)) {
            mkdir($folderPath, 0755, true);
        }

        $image_parts = explode(';base64,', $base64Image);
        $image_type_aux = explode('image/', $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $image_name = uniqid() . '.' . $image_type;
        $file = $folderPath . $image_name;

        // Try to write the file, and handle errors if any
        if (file_put_contents($file, $image_base64) !== false) {
            return 'public/storage/' . $model . '/' . $image_name;
        } else {
            return 'Error saving the file.';
        }
    }

    public function upload_file($file, $model)
    {
        $filename = time() . $file->getClientOriginalName();
        $file->move('public/storage/' . $model . '/', $filename);
        $path = 'public/storage/' . $model . '/' . $filename;

        return $path;
    }

    public function remove_file($file)
    {
        if ($file && $file != null) {
            $f = base_path() . '/' . $file;
            if (File::exists($f)) {
                unlink($f);
            }
        }
    }

    public function remove_all($files)
    {
        $avatars = array_map(function ($file) {
            $this->remove_file($file);
        }, $files->toArray());
    }
}
