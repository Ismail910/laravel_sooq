<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        // Code
    }

    public function index()
    {
        $this->authorize('viewAny', Role::class);

        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $this->authorize('create', Role::class);

        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Role::class);

        try {
            $request->validate(['name' => 'required|string|unique:roles,name']);
            $role = Role::create(['name' => $request->name]);

            foreach ($request->permissions as $permission) {
                PermissionRole::create([
                    'permission_id' => $permission,
                    'role_id' => $role->id,
                ]);
            }

            flash()->success('تم انشاء الصلاحية بنجاح', 'عملية ناجحة');
            return redirect()->route('admin.roles.index');
        } catch (\Exception $e) {
            flash()->error($e->getMessage(), 'عملية فاشلة');
            return redirect()->back();
        }
    }

    public function edit(Role $role)
    {
        $this->authorize('update', $role);

        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $this->authorize('update', $role);

        try {
            $request->validate(['name' => 'required|string|unique:roles,name,' . $role->id]);
            $role->update(['name' => $request->name]);

            PermissionRole::where('role_id', $role->id)->delete();
            foreach ($request->permissions as $permission) {
                PermissionRole::create([
                    'permission_id' => $permission,
                    'role_id' => $role->id,
                ]);
            }

            flash()->success('تم تعديل الصلاحية بنجاح', 'عملية ناجحة');
        } catch (\Exception $e) {
            flash()->error($e->getMessage(), 'عملية فاشلة');
        }
        return redirect()->back();
    }

    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);

        try {
            $role->delete();
            PermissionRole::where('role_id', $role->id)->delete();

            flash()->success('تم حذف الصلاحية بنجاح', 'هملية ناجحة');
            return redirect()->route('admin.roles.index');
        } catch (\Exception $e) {
            flash()->error($e->getMessage(), 'عملية فاشلة');
            return redirect()->back();
        }
    }
}
