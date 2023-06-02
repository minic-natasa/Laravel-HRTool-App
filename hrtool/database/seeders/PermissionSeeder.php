<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Employees
        Permission::create([
            'name' => 'employee.index',
            'group_name' => 'employees',
        ]);
        Permission::create([
            'name' => 'employee.edit',
            'group_name' => 'employees',
        ]);
        Permission::create([
            'name' => 'employee.delete',
            'group_name' => 'employees',
        ]);
        Permission::create([
            'name' => 'employee.profile',
            'group_name' => 'employees',
        ]);
        Permission::create([
            'name' => 'employee.create',
            'group_name' => 'employees',
        ]);

        //Family Members
        Permission::create([ //list of fam.members
            'name' => 'fam-member.index',
            'group_name' => 'family members',
        ]);
        Permission::create([ //profile card->fam.members
            'name' => 'fam-member.profile',
            'group_name' => 'family members',
        ]);
        Permission::create([ //my profile->add new
            'name' => 'fam-member.create',
            'group_name' => 'family members',

        ]);
        Permission::create([ //my profile->edit
            'name' => 'fam-member.edit',
            'group_name' => 'family members',

        ]);
        Permission::create([ //my profile->delete
            'name' => 'fam-member.delete',
            'group_name' => 'family members',
        ]);

        //Organizations
        Permission::create([
            'name' => 'organization.index',
            'group_name' => 'organizations',
        ]);
        Permission::create([
            'name' => 'organization.edit', //manager
            'group_name' => 'organizations',
        ]);
        Permission::create([
            'name' => 'organization.delete',
            'group_name' => 'organizations',
        ]);
        Permission::create([
            'name' => 'organization.profile',
            'group_name' => 'organizations',
        ]);
        Permission::create([
            'name' => 'organization.create',
            'group_name' => 'organizations',
        ]);

        //Positions
        Permission::create([
            'name' => 'position.index',
            'group_name' => 'positions',
        ]);
        Permission::create([
            'name' => 'position.edit',
            'group_name' => 'positions',
        ]);
        Permission::create([
            'name' => 'position.delete',
            'group_name' => 'positions',
        ]);
        Permission::create([
            'name' => 'position.profile',
            'group_name' => 'positions',
        ]);
        Permission::create([
            'name' => 'position.create',
            'group_name' => 'positions',
        ]);

        //Contracts
        Permission::create([
            'name' => 'contract.index', //list of contracts
            'group_name' => 'contracts',
        ]);
        Permission::create([ //create new contract
            'name' => 'contract.create',
            'group_name' => 'contracts',
        ]);
        Permission::create([ //delete contract->status:deleted
            'name' => 'contract.delete',
            'group_name' => 'contracts',
        ]);
        Permission::create([ //profile card->contracts
            'name' => 'contract.profile',
            'group_name' => 'contracts',
        ]);
        Permission::create([ //print contract
            'name' => 'contract.print',
            'group_name' => 'contracts',
        ]);
        Permission::create([ //print contract doc1 (mobing)
            'name' => 'contract.print-doc1',
            'group_name' => 'contracts',
        ]);
        Permission::create([ //print contract doc2 (zou)
            'name' => 'contract.print-doc2',
            'group_name' => 'contracts',
        ]);
        Permission::create([ //print contract doc3 (nda)
            'name' => 'contract.print-doc3',
            'group_name' => 'contracts',
        ]);

        //Annexes
        Permission::create([
            'name' => 'annex.index', //contract card->list of annexes
            'group_name' => 'annexes',
        ]);
        Permission::create([ //create new annex
            'name' => 'annex.create',
            'group_name' => 'annexes',
        ]);
        Permission::create([ //delete annex->status:deleted
            'name' => 'annex.delete',
            'group_name' => 'annexes',
        ]);
        Permission::create([ //profile card->annexes (see changes in contract)
            'name' => 'annex.profile',
            'group_name' => 'annexes',
        ]);
        Permission::create([ //print annex
            'name' => 'annex.print',
            'group_name' => 'annexes',
        ]);
        Permission::create([ //print notice
            'name' => 'annex.print-notice',
            'group_name' => 'annexes',
        ]);

        //Administration
        Permission::create([
            'name' => 'admin.index', //see admin panel
            'group_name' => 'administration',
        ]);
        Permission::create([ //see roles
            'name' => 'admin.role.index',
            'group_name' => 'administration',
        ]);
        Permission::create([ //create new role
            'name' => 'admin.role.create',
            'group_name' => 'administration',
        ]);
        Permission::create([ //edit role
            'name' => 'admin.role.edit',
            'group_name' => 'administration',
        ]);
        Permission::create([ //delete role
            'name' => 'admin.role.delete',
            'group_name' => 'administration',
        ]);
        Permission::create([ //see permissions
            'name' => 'admin.permission.index',
            'group_name' => 'administration',
        ]);
        Permission::create([ //create new permission
            'name' => 'admin.permission.create',
            'group_name' => 'administration',
        ]);
        Permission::create([ //edit permission
            'name' => 'admin.permission.edit',
            'group_name' => 'administration',
        ]);
        Permission::create([ //delete permission
            'name' => 'admin.permission.delete',
            'group_name' => 'administration',
        ]);
        Permission::create([ //see access
            'name' => 'admin.access.index',
            'group_name' => 'administration',
        ]);
        Permission::create([ //give role permissions
            'name' => 'admin.access.edit',
            'group_name' => 'administration',
        ]);
        Permission::create([ //delete permissions for role
            'name' => 'admin.access.delete',
            'group_name' => 'administration',
        ]);


        //Assign permissions to admin_hr
        $admin_hr = Role::where('name', 'admin_hr')->first();
        $admin_hr->givePermissionTo([
            'employee.index',
            'employee.edit',
            'employee.delete',
            'employee.profile',
            'employee.create',
            'fam-member.index',
            'fam-member.profile',
            'fam-member.create',
            'fam-member.edit',
            'fam-member.delete',
            'organization.index',
            'organization.edit',
            'organization.delete',
            'organization.profile',
            'organization.create',
            'position.index',
            'position.edit',
            'position.delete',
            'position.profile',
            'position.create',
            'contract.index',
            'contract.create',
            'contract.delete',
            'contract.profile',
            'contract.print',
            'contract.print-doc1',
            'contract.print-doc2',
            'contract.print-doc3',
            'annex.index',
            'annex.create',
            'annex.delete',
            'annex.profile',
            'annex.print',
            'annex.print-notice',
        ]);

        $admin_it = Role::where('name', 'admin_it')->first();
        $admin_it->givePermissionTo([
            'employee.index',
            'employee.delete',
            'fam-member.index',
            'fam-member.profile',
            'fam-member.create',
            'fam-member.edit',
            'fam-member.delete',
            'organization.index',
            'organization.edit',
            'organization.delete',
            'organization.profile',
            'organization.create',
            'position.index',
            'position.delete',
            'contract.profile',
            'annex.index',
            'annex.profile',
            'admin.index',
            'admin.role.index',
            'admin.role.create',
            'admin.role.edit',
            'admin.role.delete',
            'admin.permission.index',
            'admin.permission.create',
            'admin.permission.edit',
            'admin.permission.delete',
            'admin.access.index',
            'admin.access.edit',
            'admin.access.delete',
        ]);


        $user = Role::where('name', 'user')->first();
        $user->givePermissionTo([
            'employee.index',
            'fam-member.profile',
            'fam-member.create',
            'fam-member.edit',
            'fam-member.delete',
            'organization.index',
            'organization.profile',
            'contract.profile',
            'annex.index',
            'annex.profile',
        ]);
    }
}
