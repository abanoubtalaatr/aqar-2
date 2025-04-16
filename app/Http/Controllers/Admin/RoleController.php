<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\CreateRequest;
use App\Http\Requests\Admin\Role\UpdateRequest;

class RoleController extends Controller
{
    protected $view = "admin.roles.";
    protected $route = "admin.roles.";
    protected $roleRepository;

    public function index(Request $request)
    {
        $items = Role::query()->where('name', '!=', 'super-admin');

        if ($request->filled('keyword')) {
            $items = $items->where('name', 'like', "%{$request->keyword}%");
        }

        $perPage = $request->get('per_page') ?? config('general.admin_per_page');

        $items = $items->orderBy('id', 'DESC')->paginate($perPage);

        return view("{$this->view}index", ['items' => $items]);
    }


    public function create(Request $request)
    {
        $permissions = Permission::get();

        return view("{$this->view}create")
            ->with(['permissions' => $permissions]);
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray(); // Get the role's permission IDs

        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function store(CreateRequest $request)
    {

        $role = Role::create([
             'name' => $request->name,
             'name_ar' => $request->name_ar
         ]);

        $permissions = Permission::whereIn('id', $request->permissions)->get();
        $role->syncPermissions($permissions);
        $role->refresh();

        return redirect()->route("{$this->route}index")->with('success', __('Data saved successfully!'));
    }



    public function update(UpdateRequest $request, Role $role)
    {
        $role->update([
            'name' => $request->name,
            'name_ar' => $request->name_ar
        ]);

        $permissions = Permission::whereIn('id', $request->permissions)->get();
        $role->syncPermissions($permissions);
        $role->refresh();

        return redirect()->route("{$this->route}index")->with('success', __('Data saved successfully!'));
    }


    public function destroy(Role $role)
    {
        $role->delete();
        return 1;
    }

    public function show(Role $role)
    {
        return view("{$this->view}show")
            ->with(['item' => $role]);
    }
}
