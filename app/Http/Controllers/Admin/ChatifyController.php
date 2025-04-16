<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ChMessage as Message;
use App\Models\ChFavorite as Favorite;
use Chatify\Facades\ChatifyMessenger as Chatify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;

class ChatifyController extends Controller
{
    protected $perPage = 100000;

    public function getContacts(Request $request)
    {
        // Get all users with roles (excluding current user)
        $users = User::where('id', '!=', Auth::id())
            ->whereHas('roles')
            ->orderBy('name')
            ->paginate($request->per_page ?? $this->perPage);

        $usersList = $users->items();

        if (count($usersList) > 0) {
            $contacts = '';
            foreach ($usersList as $user) {
                // Get last message if exists
                $lastMessage = Message::where(function($q) use ($user) {
                    $q->where('from_id', Auth::id())
                      ->where('to_id', $user->id);
                })->orWhere(function($q) use ($user) {
                    $q->where('from_id', $user->id)
                      ->where('to_id', Auth::id());
                })->orderBy('created_at', 'desc')->first();

                $unseenCounter = Message::where('from_id', $user->id)
                                      ->where('to_id', Auth::id())
                                      ->where('seen', 0)
                                      ->count();

                $contacts .= view('Chatify::layouts.listItem', [
                    'get' => 'contact_item',
                    'user' => $user,
                    'lastMessage' => $lastMessage,
                    'unseenCounter' => $unseenCounter,
                    'isModerator' => $user->hasRole('moderator')
                ])->render();
            }
        } else {
            $contacts = '<p class="message-hint center-el"><span>No users with roles found</span></p>';
        }
        return Response::json([
            'contacts' => $contacts,
            'total' => $users->total() ?? 0,
            'last_page' => $users->lastPage() ?? 1,
        ], 200);
    }

    public function search(Request $request)
    {
        $getRecords = null;
        $input = trim(filter_var($request['input']));
        $records = User::where('id','!=',Auth::user()->id)
                    ->where('name', 'LIKE', "%{$input}%")
                    ->whereHas('roles')
                    ->paginate($request->per_page ?? $this->perPage);
        foreach ($records->items() as $record) {
            $getRecords .= view('Chatify::layouts.listItem', [
                'get' => 'search_item',
                'user' => Chatify::getUserWithAvatar($record),
            ])->render();
        }
        if($records->total() < 1){
            $getRecords = '<p class="message-hint center-el"><span>Nothing to show.</span></p>';
        }
        // send the response
        return Response::json([
            'records' => $getRecords,
            'total' => $records->total(),
            'last_page' => $records->lastPage()
        ], 200);
    }
}