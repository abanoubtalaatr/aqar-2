<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaceBuilding extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar', 'name_en'];


}
