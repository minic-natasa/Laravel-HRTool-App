<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    //PERMISSIONS
    public function permissions()
    {
        $permissions = Permission::all();
        return view('admin.administration.permissions.index', compact('permissions'));
    }

    public function create_permission()
    {
        return view('admin.administration.permissions.create');
    }

    public function store_permission(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'group_name' => 'nullable|max:255',
        ]);

        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission created successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('permissions.index')->with($notification);
    }

    public function edit_permission(string $id)
    {
        $permission = Permission::findById($id);
        return view('admin.administration.permissions.edit', compact('permission'));
    }

    public function update_permission(Request $request)
    {
        $permission_id = $request->id;
        Permission::find($permission_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('permissions.index')->with($notification);
    }

    public function destroy_permission($id)
    {
        Permission::find($id)->delete();

        $notification = array(
            'message' => 'Permission deleted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    /* ************************************************************************* */


    //ROLES
    public function roles()
    {
        $roles = Role::all();
        return view('admin.administration.roles.index', compact('roles'));
    }

    public function create_role()
    {
        return view('admin.administration.roles.create');
    }

    public function store_role(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role created successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('roles.index')->with($notification);
    }

    public function edit_role(string $id)
    {
        $role = Role::findById($id);
        return view('admin.administration.roles.edit', compact('role'));
    }

    public function update_role(Request $request)
    {
        $role_id = $request->id;
        Role::find($role_id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('roles.index')->with($notification);
    }

    public function destroy_role($id)
    {
        Role::find($id)->delete();

        $notification = array(
            'message' => 'Role deleted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /* ************************************************************************* */


    public function roles_in_permissions_index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.administration.roles-in-permissions-index', compact('roles', 'permissions'));
    }

    public function roles_in_permissions_create()
    {

        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
        return view('admin.administration.roles-in-permissions-create', compact('roles', 'permissions', 'permission_groups'));
    }

    public function roles_in_permissions_store(Request $request)
    {

        $data = array();
        $permissions = $request->permission;

        foreach ($permissions as $key => $item) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        }

        $notification = array(
            'message' => 'Role connected successfully with Permission!',
            'alert-type' => 'success'
        );

        return redirect()->route('roles.permissions.index')->with($notification);
    }

    public function roles_in_permissions_edit(string $id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
        return view('admin.administration.roles-in-permissions-edit', compact('role', 'permissions', 'permission_groups'));
    }


    public function roles_in_permissions_update(Request $request, $id)
    {
        $role = Role::find($id);
        $permissions = $request->permission;

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        if (empty($permissions)) {
            DB::table('role_has_permissions')
                ->where('role_id', $id)
                ->delete();
        }

        $notification = array(
            'message' => 'Role updated successfully with Permission!',
            'alert-type' => 'success'
        );

        return redirect()->route('roles.permissions.index')->with($notification);
    }

    public function roles_in_permissions_destroy($id)
    {

        DB::table('role_has_permissions')
            ->where('role_id', $id)
            ->delete();

        $notification = array(
            'message' => 'Permissions for Role deleted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('roles.permissions.index')->with($notification);
    }
}
