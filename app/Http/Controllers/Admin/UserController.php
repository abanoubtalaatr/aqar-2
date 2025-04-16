<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\License;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Client\CreateRequest;
use App\Http\Requests\Admin\Client\UpdateRequest;

class UserController extends Controller
{
    protected $view = "admin.users.";
    protected $route = "admin.users.";
    protected $userRepository;
    public function index(Request $request)
    {
        $query = User::whereDoesntHave('roles');

        // Search by keyword (name, email, phone)
        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('email', 'like', '%' . $request->keyword . '%')
                    ->orWhere('phone', 'like', '%' . $request->keyword . '%');
            });
        }

        // Filter by License Type & Status
        if ($request->filled('license_type') || $request->filled('license_status')) {
            $query->whereHas('licenses', function ($q) use ($request) {
                if ($request->filled('license_type')) {
                    $q->where('type', $request->license_type)->where('status', License::STATUS_ACTIVE);
                }
                if ($request->filled('license_status')) {
                    $q->where('status', $request->license_status);
                }
            });
        }

        $perPage = $request->get('per_page', config('general.admin_per_page', 25));
        $items = $query->orderBy('id', 'DESC')->paginate($perPage);

        return view("{$this->view}index", compact('items'));
    }



    public function create()
    {
        return view("{$this->view}create");
    }

    public function edit(User $user)
    {
        return view("{$this->view}edit")
            ->with(['item' => $user]);
    }

    public function store(CreateRequest $request)
    {
        $user = User::create($request->validated());

        return redirect()->route("{$this->route}index")->with('success', __('Data saved successfully!'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        $user->update($request->validated());
        return redirect()->route("{$this->route}index")->with('success', __('Data saved successfully!'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return 1;
    }

    public function show(User $user)
    {
        return view("{$this->view}show")
            ->with(['item' => $user]);
    }
}
