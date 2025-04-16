<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\CreateRequest;
use App\Http\Requests\Admin\Admin\UpdateRequest;

class AdminController extends Controller
{
    protected $view = "admin.admins.";
    protected $route = "admin.admins.";

    public function index(Request $request)
    {
        $query = User::whereHas('roles', function ($query) {
            $query->where('name', '!=', 'super-admin');
        });

        if ($request->filled('keyword')) {
            $search = $request->keyword;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                ;
            });
        }

        $perPage = $request->get('per_page') ?? config('general.admin_per_page');

        $items = $query->orderBy('id', 'DESC')->paginate($perPage);

        return view("{$this->view}index", ['items' => $items]);
    }

    public function create()
    {
        $roles = Role::where('name', '!=', 'super-admin')->get();

        return view("{$this->view}create")->with(['roles' => $roles]);
    }

    public function edit($id)
    {
        $user = User::find($id);

        $roles = Role::where('name', '!=', 'super-admin')->get();

        return view("{$this->view}edit")
            ->with(['item' => $user, 'roles' => $roles]);
    }

    public function store(CreateRequest $request)
    {
        $user = User::create($request->except(['role_id', 'password_confirmation']));

        if ($request->has('role_id')) {
            $role = Role::find($request->role_id);

            if ($role) {
                $user->assignRole($role);
            }
        }

        return redirect()->route("{$this->route}index")->with('success', __('Data saved successfully!'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $user = User::find($id);

        $user->update($request->except(['role_id', 'password_confirmation']));

        if ($request->has('role_id')) {
            $role = Role::find($request->role_id);

            if ($role) {
                $user->syncRoles([$role->id]);
            }
        }

        return redirect()->route("{$this->route}index")->with('success', __('Data saved successfully!'));
    }
}
