<?php

namespace App\Http\Controllers\Api;

use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Api\NotificationResource;

class NotificationController extends Controller
{
    use GeneralTrait;

    /**
     * Get all notifications for the authenticated user.
     */
    public function index()
    {
        // Get paginated notifications
        $notifications = Auth::user()->notifications()->paginate(10);

        // Group notifications by day
        $groupedNotifications = $notifications->getCollection()->groupBy(function ($notification) {
            return $notification->created_at->translatedFormat('d-F-Y'); // Group by date (Y-m-d format)
        });

        // Replace the original collection with the grouped data
        $groupedData = $groupedNotifications->map(function ($group, $date) {
            return [
                'date' => $date,
                'notifications' => NotificationResource::collection($group),
            ];
        })->values();

        // Add the grouped data back to the paginated instance
        $notifications->setCollection($groupedData);


        return $this->returnData('data', $notifications);
    }

    /**
     * Get all unread notifications for the authenticated user, grouped by day.
     */
    public function unread()
    {
        // Get paginated unread notifications
        $unreadNotifications = Auth::user()->unreadNotifications()->paginate(10);

        // Group unread notifications by day
        $groupedNotifications = $unreadNotifications->getCollection()->groupBy(function ($notification) {
            return $notification->created_at->translatedFormat('d-F-Y'); // Group by date (Y-m-d format)
        });

        // Replace the original collection with the grouped data
        $groupedData = $groupedNotifications->map(function ($group, $date) {
            return [
                'date' => $date,
                'notifications' => NotificationResource::collection($group),
            ];
        })->values();

        // Add the grouped data back to the paginated instance
        $unreadNotifications->setCollection($groupedData);

        return $this->returnData('data', $unreadNotifications);
    }



    /**
     * Mark a specific notification as read.
     */
    public function markAsRead($id)
    {
        $notification =  Auth::user()->notifications()->find($id);

        if (!$notification) {
            return $this->returnError('404', 'Notification not found.');
        }

        $notification->markAsRead();

        return $this->returnSuccessMessage('Notification marked as read.');
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return $this->returnSuccessMassage('All notifications marked as read.');
    }

    /**
     * Delete a specific notification.
     */
    public function destroy($id)
    {
        $notification = Auth::user()->notifications()->find($id);

        if (!$notification) {
            return $this->returnError('404', 'Notification not found.');
        }

        $notification->delete();

        return $this->returnSuccessMessage('Notification deleted.');
    }

    /**
     * Delete all notifications.
     */
    public function deleteAllNotifications()
    {
        Auth::user()->notifications()->delete();

        return $this->returnSuccessMessage('All notifications deleted.');
    }

    public function notificationCounts()
    {
        return $this->returnData('data', Auth::user()->unreadNotifications()->count());
    }
}
