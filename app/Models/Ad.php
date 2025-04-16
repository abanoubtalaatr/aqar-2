<?php

namespace App\Models;

use App\Constants\AdStatus;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\HasActiveUserScope;
use App\Http\Resources\Web\SimilarAdResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ad extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        // Apply the global scope
        static::addGlobalScope(new HasActiveUserScope());
    }
    //=============================Scopes==========================================

    public function scopeActive($query)
    {
        return $query->where('is_active', '1')->whereStatus(AdStatus::ACTIVE);
    }

    public function scopeHasCategory($query)
    {
        return $query->whereHas('category');
    }

    public function scopeHasLicenseNumber($query)
    {
        return $query->whereNotNull('license_number');
    }

    public function scopeIsPublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    // =============================Relations======================================
    public function adable()
    {
        return $this->morphTo();
    }

    public function files()
    {
        return $this->hasMany(File::class, 'ad_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }

    public function keys()
    {
        return $this->hasMany(AdKey::class);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function chatWithUser($adId = null)
    {
        if (!$adId) {
            return ''; // Return null if no ad ID is provided
        }

        $ad = Ad::find($adId);

        if (!$ad) {
            return null; // Return null if the ad does not exist
        }

        // Check if a chat exists between the ad owner and the authenticated user
        return Chat::where('ad_id', $adId)
            ->where(function ($query) use ($ad) {
                $authUserId = auth()->id();

                $query->where(function ($subQuery) use ($authUserId, $ad) {
                    $subQuery->where(function ($innerQuery) use ($authUserId, $ad) {
                        $innerQuery->where('sender_id', $authUserId)
                            ->where('receiver_id', $ad->user_id);
                    })->orWhere(function ($innerQuery) use ($authUserId, $ad) {
                        $innerQuery->where('receiver_id', $authUserId)
                            ->where('sender_id', $ad->user_id);
                    });
                });
            })
            ->first();
    }


    public function similar_products()
    {
        if (is_null($this->category_id) || is_null($this->area) || is_null($this->price)) {
            return $this->newQuery()->whereRaw('1 = 0'); // Return empty query if conditions not met
        }

        $areaRange = [
            'min' => $this->area * 0.5,
            'max' => $this->area * 1.5
        ];

        $priceRange = [
            'min' => $this->price * 0.5,
            'max' => $this->price * 1.5
        ];

        return $this->where('category_id', $this->category_id)
            ->whereBetween('area', [$areaRange['min'], $areaRange['max']])
            ->whereBetween('price', [$priceRange['min'], $priceRange['max']])
            ->where('id', '!=', $this->id)
            ->whereHas('user', function ($query) {
                $query->whereNull('deleted_at');
            })
            ->limit(3);
    }
    // ============================End Relation===================================

    // ============================Accessors & Mutators ============================
    public function getNameAttribute()
    {
        return $this->getCategoryName() . ' ' . $this->getRentDescription() . ' ' . $this->getCityName();
    }

    protected function getCategoryName()
    {
        return optional($this->category)->name;
    }

    protected function getRentDescription()
    {
        switch ($this->for_rent) {
            case 0:
                return __('dashboard.for_buy');
            case 1:
                return __('dashboard.for_rent');
            case 2:
                return __('dashboard.for_buy_or_rent');
            default:
                return '';
        }
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

    protected function getCityName()
    {
        return optional($this->city)->name;
    }

    public function getAdNumberAttribute()
    {
        return Ad::where('id', '<', $this->id)->count();
    }

    public function getIsFavouriteAttribute()
    {
        if (auth()->guard('api')->check()) {
            return Favourite::where([
                'ad_id' => $this->id,
                'user_id' => auth()->guard('api')->user()->id,
            ])->exists();
        } else {
            return false;
        }
    }

    public function getIsFamilyAttribute($val)
    {
        if ($val === 0) {
            return __('site.for_family');
        } elseif ($val == 1) {
            return __('site.for_singles');
        } elseif ($val == 2) {
            return __('site.for_family') . ' ' . __('site.and') . ' ' . __('site.for_singles');
        }
    }

    // public function getAdvertiserRelationshipWithPropertyAttribute($val)
    // {
    //     if ($val == 0) {
    //         return __('dashboard.owner');
    //     } elseif ($val == 1) {
    //         return __('dashboard.agent');
    //     } elseif ($val == 2) {
    //         return __('dashboard.marketer');
    //     }
    // }
    public function getAdvertiserRelationshipWithPropertyValAttribute($val)
    {
        if ($val == 0) {
            return __('dashboard.owner');
        } elseif ($val == 1) {
            return __('dashboard.agent');
        } elseif ($val == 2) {
            return __('dashboard.marketer');
        }
    }

    // public function getRentingDurationAttribute($val)
    // {
    //     if ($val == 0) {
    //         return __('dashboard.daily');
    //     } elseif ($val == 1) {
    //         return __('dashboard.monthly');
    //     } elseif ($val == 2) {
    //         return __('dashboard.yearly');
    //     }
    // }
    public function getRentingDurationValAttribute($val)
    {
        if ($val == 0) {
            return __('dashboard.daily');
        } elseif ($val == 1) {
            return __('dashboard.monthly');
        } elseif ($val == 2) {
            return __('dashboard.yearly');
        }
    }

    // =============================End Accessors & Mutators ============================

    // ============================= Methods ==============================================
    // public function simillarAds()
    // {

    //     $simillar_ads = Ad::active()->where('cat_id', $this->cat_id)
    //         ->Where('id', '!=', $this->id)
    //         ->paginate(2);
    //     if ($simillar_ads) {
    //         return  SimillarAdResource::collection($simillar_ads)->response()->getData(true);
    //     }
    // }

    // This return First image of ad because he might add first element as video
    public function firstImage()
    {
        foreach ($this->files as $file) {
            if ($file->getTypeAttribute() === 0) {
                return $file;
            }
        }
    }

    public function SimilarAds()
    {

        $SimilarAds = Ad::active()->where('category_id', $this->category_id)
            ->Where('id', '!=', $this->id)->get();
        // ->paginate(3);
        if ($SimilarAds) {
            return SimilarAdResource::collection($SimilarAds)->response()->getData(true);
        }
    }

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'rateable');
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }
    // ================================== End Methods ================================

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

    public function favoriteCount()
    {
        return $this->favorites()->count();
    }
    public function faceBuilding()
    {
        return $this->belongsTo(FaceBuilding::class);
    }

    public function visits()
    {
        return $this->morphMany(UserVisit::class, 'visitable');
    }
}
