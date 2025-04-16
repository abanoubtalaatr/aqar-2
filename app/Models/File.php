<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';

    public $timestamps = false;

    protected $guarded = [];

    protected $appends = ['full_path'];
    protected $casts = [
        'type' => 'string',
    ];

    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
    // public function getTypeAttribute()
    // {
    //     $extension = pathinfo($this->path, PATHINFO_EXTENSION);
    //     $imageExtensions = [
    //         'jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz',
    //         'cgm', 'djv', 'djvu', 'ico', 'ief', 'jpe', 'pbm', 'pgm', 'pnm', 'ppm',
    //         'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd', 'webp',
    //     ];
    //     if (in_array($extension, $imageExtensions)) {
    //         return 'image';
    //     } else {
    //         // video
    //         return 'video';
    //     }
    // }

    public function getFullPathAttribute()
    {
        return url('/'. $this->path);
    }
}
