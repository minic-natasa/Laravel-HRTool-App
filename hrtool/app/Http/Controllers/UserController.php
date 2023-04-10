<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //Display Users page
    public function index()
    {
        $users = User::all();
        return view('users.index', ['users' => $users]);
        //return view('users.index', compact('users'));
    }

    public function profile_card(string $id)
    {
        $user = User::find($id);
        return view('users.profile-card', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'bank_account_number' => 'required|string',
            'emergency_contact_name' => 'required|string',
            'emergency_contact_number' => 'required|string',
            'manager' => 'required|boolean',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'employee_number' => 'required|string|unique:users,employee_number',
            'name_of_one_parent' => 'required|string',
            'birth_date' => 'required|date',
            'address_in_ID' => 'required|string',
            'current_address' => 'required|string',
            'slava' => 'required|string',
            'private_email' => 'required|email|unique:users,private_email',
            'mobile' => 'required|string|unique:users,mobile',
            'bank_account_number' => 'required|string',
            'jmbg' => 'required|integer|unique:users,jmbg',
            'ID_number' => 'required|integer|unique:users,ID_number',
            'passport_number' => 'required|integer|unique:users,passport_number',
            'family_member_id' => 'nullable|exists:family_members,id',
        ]);

     

        $user = new User([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'manager' => $request->input('manager'),
            'bank_account_number' => $request->input('bank_account_number'),
            'emergency_contact_name' => $request->input('emergency_contact_name'),
            'emergency_contact_number' => $request->input('emergency_contact_number'),
            'family_member_id' => $request->input('family_member_id'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'employee_number' => $request->input('employee_number'),
            'name_of_one_parent' => $request->input('name_of_one_parent'),
            'birth_date' => $request->input('birth_date'),
            'address_in_ID' => $request->input('address_in_ID'),
            'current_address' => $request->input('current_address'),
            'slava' => $request->input('slava'),
            'private_email' => $request->input('private_email'),
            'mobile' => $request->input('mobile'),
            'jmbg' => $request->input('jmbg'),
            'ID_number' => $request->input('ID_number'),
            'passport_number' => $request->input('passport_number'),
           
        ]);

        $user->save();

        return redirect('/users')->with('success', 'User created successfully!');
    }

    public function edit(string $id)
    {
        $user = User::find($id);

        return view('users.edit', compact('user'));
    }




    public function update(Request $request, string $id)
    {
        $request->validate([
           
            'first_name' => 'required',
            'last_name' => 'required',
            'name_of_one_parent' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'manager' => 'required',
            'bank_account_number' => 'required',
            'emergency_contact_name' => 'required',
            'emergency_contact_number' => 'required',
            'employee_number' => 'required',
            'birth_date' => 'required',
            'address_in_ID' => 'required',
            'current_address' => 'required',
            'slava' => 'required',
            'private_email' => 'required|email',
            'mobile' => 'required',
            'jmbg' => 'required',
            'ID_number' => 'required',
            'passport_number' => 'required',
            
            
        ]);

        $user = User::find($id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->name_of_one_parent = $request->input('name_of_one_parent');
        $user->email = $request->input('email');
        $user->manager = $request->input('manager');
        $user->password = bcrypt($request->input('password'));
        $user->bank_account_number = $request->input('bank_account_number');
        $user->emergency_contact_name = $request->input('emergency_contact_name');
        $user->emergency_contact_number = $request->input('emergency_contact_number');
        $user->family_member_id = $request->input('family_member_id');
        $user->employee_number = $request->input('employee_number');
        $user->birth_date = $request->input('birth_date');
        $user->address_in_ID = $request->input('address_in_ID');
        $user->current_address = $request->input('current_address');
        $user->slava = $request->input('slava');
        $user->private_email = $request->input('private_email');
        $user->mobile = $request->input('mobile');
        $user->jmbg = $request->input('jmbg');
        $user->ID_number = $request->input('ID_number');
        $user->passport_number = $request->input('passport_number');

        $user->save();

        return redirect('/users')->with('success', 'User updated successfully!');
    }




    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/users')->with('success', 'User deleted successfully!');
    }
}
