<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\General\FormatFileService;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key','value','group','type', 'sort'];


    public function getValueAttribute($value)
    {
        if ($this->type === 'file' && !empty($value)) {
            if (request()->is('api/*')) {
                return FormatFileService::formatIfString($value, 'public/storage');
            }
        }

        return $value;
    }
}
