<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Notifications\SendNotificationToUser;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $perPage = $request->get('per_page') ?? config('general.admin_per_page');

        $query = DB::table('notifications')
            ->join('users', 'notifications.notifiable_id', '=', 'users.id')
            ->select('notifications.*', 'users.name as user_name', 'users.email as user_email')
            ->latest();

        // Apply search filters if a keyword is provided
        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->where('users.name', 'like', "%{$keyword}%")
                    ->orWhere('users.id', 'like', "%{$keyword}%")
                    ->orWhere('notifications.data', 'like', "%{$keyword}%");
            });
        }

        $items = $query->paginate($perPage);

        return view('admin.notifications.index', compact('items'));
    }


    public function send(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $message = $validated['message'];

        if ($validated['user_id']) {
            $user = User::find($validated['user_id']);
            $user->notify(new SendNotificationToUser($message));
        } else {
            // Send to all users
            $users = User::whereDoesntHave('roles')->get();

            foreach ($users as $user) {
                $user->notify(new SendNotificationToUser($message));
            }
        }

        return redirect()->route('admin.notifications.index')->with('success', __('dashboard.Notification sent successfully!'));
    }

    public function create()
    {
        $users = User::whereDoesntHave('roles')->get();

        return view('admin.notifications.create', compact('users'));
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return 1;
    }
}
