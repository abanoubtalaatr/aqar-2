<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    // Constants for license types
    public const TYPE_TOURISM = 'Tourism';
    public const TYPE_REAL_ESTATE = 'Real Estate Authority';

    // Constants for statuses
    public const STATUS_PENDING = 'pending';
    public const STATUS_ACTIVE = 'active';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_INACTIVE = 'inactive';

    protected $fillable = [
        'user_id',
        'type',
        'status',
        'file',
    ];

    // Get all types
    public static function getTypes(): array
    {
        return [
            self::TYPE_TOURISM,
            self::TYPE_REAL_ESTATE,
        ];
    }

    // Get all statuses
    public static function getStatuses(): array
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_ACTIVE,
            self::STATUS_REJECTED,
            self::STATUS_INACTIVE,
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
