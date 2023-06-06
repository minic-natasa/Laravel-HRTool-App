<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function admin_index()
    {
        $admins = User::where('role', 'admin')->get();
        $roles = Role::pluck('name', 'id');
        return view('admin.administration.admin-panel', compact('admins', 'roles'));
    }


    public function admin_destroy(string $id)
    {
        $user = User::find($id);
        $user->role = 'user';
        $user->syncRoles(['user']);
        $user->save();

        $notification = array(
            'message' => 'Admin Role removed successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function admin_create()
    {
        $roles = Role::where('name', '!=', 'user')->get();
        $users = User::whereHas('roles', function ($query) {
            $query->where('role_id', 3); // Assuming role_id 3 corresponds to the users role
        })->get();

        return view('admin.administration.admin-add', compact('users', 'roles'));
    }

    public function admin_store(Request $request)
    {
        $user = User::find($request->model_id);

        $user->role = 'admin';
        $user->save();

        $user->syncRoles([$request->role_id]);

        $notification = array(
            'message' => 'Admin added successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin-panel.index')->with($notification);
    }
}
