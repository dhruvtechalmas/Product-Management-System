<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();

        return view('roles.index', compact('roles', 'permissions'));
    }

    public function update(Request $request)
    {
        foreach ($request->roles as $roleId => $perms) {

            $role = Role::find($roleId);

            if ($role) {
                $role->syncPermissions($perms ?? []);
            }
        }

        return back()->with('success', 'Permissions updated');
    }
}