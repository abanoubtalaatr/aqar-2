<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'ad_id',
        'order_id',
        'chat_id',
        'sender_id',
        'receiver_id',
        'receiver_read_at',
        'sender_read_at',
        'message',
        'file',
        'is_closed',
        'is_blocked',
        'blocked_by',
        'is_first_message',
    ];

    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * Get the latest chat between the authenticated user and the other user for a specific ad.
     */
    public static function getLatestChat(int $adId = null, $orderId = null, int $userId)
    {
        if ($adId) {
            return self::query()
                ->where(function ($query) use ($userId) {
                    $query->where('receiver_id', $userId)
                        ->orWhere('sender_id', $userId);
                })
                ->where('ad_id', $adId)
                ->orderByDesc('created_at')
                ->first();
        }

        return self::query()
            ->where(function ($query) use ($userId) {
                $query->where('receiver_id', $userId)
                    ->orWhere('sender_id', $userId);
            })
            ->where('order_id', $orderId)
            ->orderByDesc('created_at')
            ->first();
    }

    /**
     * Get the count of unread messages for the authenticated user for a specific ad.
     */
    public static function getUnreadMessagesCount($adId = null, $orderId = null, int $userId)
    {
        $query = self::query()
            ->where('receiver_id', $userId)
            ->whereNull('receiver_read_at')
            ->where('sender_id', '!=', $userId);

        if ($adId) {
            return $query->where('ad_id', $adId)->count();
        }
        if ($orderId) {
            return $query->where('order_id', $orderId)->count();
        }
        return $query->count();
    }

    /**
     * Check if the chat is blocked.
     */
    public function isBlocked(): bool
    {
        return $this->is_blocked;
    }

    /**
     * Block the chat.
     */
    public function block(int $userId): bool
    {
        $this->update([
            'is_blocked' => true,
            'blocked_by' => $userId,
        ]);
        return true;
    }

    /**
     * Unblock the chat.
     */
    public function unblock(): bool
    {
        $this->update([
            'is_blocked' => false,
            'blocked_by' => null,
        ]);
        return true;
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
