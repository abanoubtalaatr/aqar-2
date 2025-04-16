<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\HasActiveUserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'for_rent',
        'category_id',
        'user_id',
        'meter_price',
        'price_from',
        'price_to',
        'currency_id',
        'area_from',
        'area_to',
        'map_latitude',
        'map_longitude',
        'description',
        'orderable_type',
        'property_age',
        'neighborhood_id',
        'orderable_id',
        'has_files',
        'street_width_from',
        'street_width_to',
        'published_at',
        'city_id',
        'map_address',
        'face_building_id',
        'renting_duration',
        'property_age_to',
        'property_age_from',
        'is_updated',
        'is_active'
    ];

    protected static function boot()
    {
        parent::boot();

        // Apply the global scope
        static::addGlobalScope(new HasActiveUserScope());
    }

    public function orderable()
    {
        return $this->morphTo();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function faceBuilding()
    {
        return $this->belongsTo(FaceBuilding::class);
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }

    protected function getForRentValAttribute()
    {
        $val = $this->attributes['for_rent'];

        if ($val === '0') {
            return __('dashboard.for_buy');
        } elseif ($val === '1') {
            return __('dashboard.for_rent');
        } elseif ($val === '2') {
            return __('dashboard.for_buy_or_rent');
        }
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

    public function favoriteCount()
    {
        return $this->favorites()->count();
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function chatWithUser($orderId = null)
    {
        if (!$orderId) {
            return ''; // Return null if no ad ID is provided
        }

        $order = Order::find($orderId);

        if (!$order) {
            return null; // Return null if the ad does not exist
        }

        // Check if a chat exists between the ad owner and the authenticated user
        return Chat::where('order_id', $order)
            ->where(function ($query) use ($order) {
                $authUserId = auth()->id();

                $query->where(function ($subQuery) use ($authUserId, $order) {
                    $subQuery->where(function ($innerQuery) use ($authUserId, $order) {
                        $innerQuery->where('sender_id', $authUserId)
                            ->where('receiver_id', $order->user_id);
                    })->orWhere(function ($innerQuery) use ($authUserId, $order) {
                        $innerQuery->where('receiver_id', $authUserId)
                            ->where('sender_id', $order->user_id);
                    });
                });
            })
            ->first();
    }
    public function visits()
    {
        return $this->morphMany(UserVisit::class, 'visitable');
    }
}
