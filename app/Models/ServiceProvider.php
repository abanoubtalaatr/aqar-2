<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    protected $fillable = ['service_type_id', 'emails', 'is_active'];

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }
}
