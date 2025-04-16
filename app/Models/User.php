<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use SoftDeletes;


    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // ==============JWT=======================

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function token()
    {
        return JWTAuth::fromUser($this);
    }

    // ====================Mutators===================
    public function setPasswordAttribute($val)
    {
        $this->attributes['password'] = Hash::make($val);
    }

    // =========================Scopes===============================

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
    //==================================================================

    public function favourites()
    {
        return $this->belongsToMany(Ad::class, 'favourites', 'user_id', 'ad_id');
    }

    public function alreadyFavourite($ad_id)
    {
        return self::favourites()->where('ad_id', $ad_id)->exists();
    }

    public function getGenderAttribute($val)
    {
        if ($val == '0') {
            return $val = 'man';
        } else {
            return $val = 'woman';
        }
    }

    public function getRateAttribute()
    {
        $r = 0;
        foreach ($this->rates as $rate) {
            $r += $rate->rate;
        }
        if ($this->rates->count() > 0) {
            $r = round($r / $this->rates->count());
        }

        return $r;
    }

    public function getCurrentRateAttribute()
    {
        if (auth()->guard('api')->check()) {
            $rater_id = auth()->guard('api')->user()->id;
            $rate = UserRate::where([
                'rater_id' => $rater_id,
                'user_id' => $this->id,
            ])->first();

            return $rate ? $rate->rate : 0;
        } else {
            return 0;
        }
    }

    // جلب المستخدمين الذين يتابعهم المستخدم الحالي
    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
    }

    // جلب المتابعين
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    //============================= For Rating Users =============================

    public function alreadyRate($user_id)
    {
        return self::rates()->where('user_id', $user_id)->exists();
    }

    //==========================================================
    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'rateable');
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }

    public function blockedUsers()
    {
        return $this->hasMany(BlockedUser::class, 'user_id');
    }

    public function isBlocking($userId): bool
    {
        return $this->blockedUsers()->where('blocked_user_id', $userId)->exists();
    }

    public function licenses()
    {
        return $this->hasMany(License::class);
    }

    public function getRealEstateAuthorityLicense()
    {
        return $this->licenses()->where('type', 'Real Estate Authority')->first();
    }

    public function getTourismLicense()
    {
        return $this->licenses()->where('type', 'Tourism')->first();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function visits()
    {
        return $this->hasMany(UserVisit::class);
    }

    public function getAvatarAttribute($value)
    {
        // If value is empty or contains a URL, use default
        if (empty($value) || $value == '') {
            $value = 'avatar.png';
        }

        // Remove any existing path components
        $cleanName = basename($value);

        // Verify file exists
        if (!Storage::exists('public/users-avatar/'.$cleanName)) {
            $cleanName = 'avatar.png';
        }

        // Return SINGLE instance of the URL
        return asset('storage/users-avatar/'.$cleanName);
    }
}
