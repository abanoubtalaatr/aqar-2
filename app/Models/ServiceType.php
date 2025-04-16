<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar','name_en', 'type','is_active'];

    public const ENGINEERING = 'engineering';
    public const DECORATION = 'decoration';
    public const CONSTRUCTION = 'construction';

    public static function getTypes(): array
    {
        return [
            self::ENGINEERING,
            self::DECORATION,
            self::CONSTRUCTION
        ];
    }

    public function getNameAttribute()
    {
        if (app()->getLocale() == 'en') {
            return $this->name_en;
        }

        return $this->name_ar;
    }
}
