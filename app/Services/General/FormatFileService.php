<?php

namespace App\Services\General;

class FormatFileService
{
    public static function formatFileIfModel($file)
    {
        if (!$file) {
            return [];
        }

        if ($file instanceof \Illuminate\Support\Collection || is_array($file)) {
            // Handle collection
            return $file->map(function ($item) {
                return self::formatSingleFile($item);
            })->toArray();
        }

        // Handle single file
        return self::formatSingleFile($file);
    }

    private static function formatSingleFile($file)
    {
        $extension = pathinfo($file->path ?? '', PATHINFO_EXTENSION);

        return [
            'id' => (string) $file->id,
            'url' => url('') . '/' . $file->path,
            'type' => self::getFileType($extension),
        ];
    }

    public static function formatIfString($file, $path = 'public/storage/chats/')
    {
        if (!$file) {
            return [];
        }

        $files = is_array($file) ? $file : explode(',', $file);

        return collect($files)->map(function ($file) use ($path) {
            $fullPath = url('') . '/' . trim($path, '/') . '/' . ltrim($file, '/');
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $type = self::getFileType($extension);

            return [
                'id' => "",
                'url' => $fullPath,
                'type' => $type,
            ];
        })->toArray();
    }

    private static function getFileType($extension)
    {
        $extension = strtolower($extension);

        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
            return 'image';
        } elseif (in_array($extension, ['mp3', 'wav', 'ogg','aac'])) {
            return 'audio';
        } elseif (in_array($extension, ['mp4', 'mov', 'avi', 'mkv'])) {
            return 'video';
        } elseif (in_array($extension, ['pdf'])) {
            return 'pdf';
        } else {
            return 'unknown';
        }
    }
}
