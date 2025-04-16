<?php

namespace App\Services;

use App\Models\Chat;
use App\Models\File;
use App\Traits\FileManagementTrait;

class UploadFileForChatService
{
    use FileManagementTrait;

    public function upload($file, Chat $chat, $fileType = null)
    {
        // Create the file entry after validation passes
        $file = File::create([
            'path' => $this->upload_file($file, 'Chat'),
            'description' => "",
            'chat_id' => $chat->id,
            'type' => $fileType
        ]);

        return $file;
    }
}
