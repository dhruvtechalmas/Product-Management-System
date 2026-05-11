<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::whereIn('name', ['admin', 'staff'])->get();
        $permissions = Permission::all();


        return view('users.index', compact('users', 'roles', 'permissions'));
    }

    public function updateRole(Request $request)
    {
        $user = User::find($request->user_id);

        if ($user) {
            $user->syncRoles([$request->role]);
        }

        return redirect()->route('users.index')->with('success', 'Role updated');
    }


    public function updatePermissions(Request $request)
    {
        if (!auth()->user()->hasRole('super-admin')) {
            abort(403, 'Unauthorized');
        }


        // dd($request->all());
        $user = User::find($request->user_id);

        if ($user->hasRole('super-admin')) {
            return back()->with('error', 'Cannot modify super admin');
        }

        $user->syncRoles([$request->role]);
        $user->syncPermissions($request->permissions ?? []);

        return back()->with('success', 'User updated');
    }

    public function delete($id)
    {
        // dd('DELETE HIT', $id);
        $user = User::find($id);


        if (!$user) {
            return back()->with('error', 'User not found');
        }

        if ($user->hasRole('super-admin')) {
            return back()->with('error', 'Cannot delete super admin');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Deleted successfully');
    }
}
