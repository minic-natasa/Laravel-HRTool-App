<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function admin_index()
    {
        $admins = User::where('role', 'admin')->get();
        $roles = Role::pluck('name', 'id');
        return view('admin.administration.admin-panel', compact('admins', 'roles'));
    }
}
