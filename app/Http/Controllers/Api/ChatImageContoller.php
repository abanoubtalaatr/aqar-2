<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChatImage;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class ChatImageContoller extends Controller
{
    use GeneralTrait;

    public function store(Request $request)
    {
        $pathes = [];
        if ($request->has('files')) {
            foreach ($request['files'] as $i) {
                $file = $this->upload_file($i, 'chat_images');
                $pathes[] = url('').'/'.$file;
                ChatImage::create([
                    'path' => $file,
                ]);
            }
        }

        return $pathes;
    }
}
