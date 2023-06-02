<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Organization;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //Display Users page
    public function index()
    {
        $contracts = Contract::all();
        $organizations = Organization::all();
        $positions = Position::all();
        $users = User::all();
        return view('users.index', ['users' => $users], compact('contracts', 'organizations', 'positions'));
        //return view('users.index', compact('users'));
    }

    public function profile_card(string $id)
    {
        $organizations = Organization::all();
        $positions = Position::all();
        $user = User::find($id);
        return view('users.profile-card', compact('user', 'organizations', 'positions'));
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
            'bank_account_number' => 'string',
            'emergency_contact_name' => 'string',
            'emergency_contact_number' => 'string',
            'manager' => 'boolean',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'employee_number' => 'unique:users,employee_number',
            'name_of_one_parent' => 'string',
            'birth_date' => 'date',
            'address_in_ID' => 'string',
            'current_address' => 'string',
            'slava' => 'string',
            'private_email' => 'email|unique:users,private_email',
            'mobile' => 'string|unique:users,mobile',
            'jmbg' => 'integer|unique:users,jmbg',
            'ID_number' => 'integer|unique:users,ID_number',
            'passport_number' => 'integer|unique:users,passport_number',
            'professional_qualifications_level'  => 'string',
            'profession'  => 'string',
        ]);



        $user = new User([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'manager' => $request->input('manager'),
            'bank_account_number' => $request->input('bank_account_number'),
            'emergency_contact_name' => $request->input('emergency_contact_name'),
            'emergency_contact_number' => $request->input('emergency_contact_number'),
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
            'professional_qualifications_level' => $request->input('professional_qualifications_level'),
            'profession' => $request->input('profession'),


        ]);

        if ($request->file('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $user['profile_picture'] = $filename;
        }

        $user->role = 'user';
        $user->assignRole('user');


        $user->save();

        $notification = array(
            'message' => 'User created successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('users.index')->with($notification);
    }

    public function edit(string $id)
    {
        $user = User::find($id);

        return view('users.edit', compact('user'));
    }




    public function update(Request $request, string $id)
    {

        $request->validate([
            'name_of_one_parent' => 'required',
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
            'professional_qualifications_level'  => 'required',
            'profession'  => 'required',
        ]);

        $user = User::find($id);
        $user->name_of_one_parent = $request->input('name_of_one_parent');
        $user->manager = $request->input('manager');
        $user->bank_account_number = $request->input('bank_account_number');
        $user->emergency_contact_name = $request->input('emergency_contact_name');
        $user->emergency_contact_number = $request->input('emergency_contact_number');
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
        $user->professional_qualifications_level = $request->input('professional_qualifications_level');
        $user->profession = $request->input('profession');

        if ($request->file('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $user['profile_picture'] = $filename;
        }

        $user->save();

        $notification = array(
            'message' => 'User updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('users.index')->with($notification);
    }




    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        $notification = array(
            'message' => 'User deleted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('users.index')->with($notification);
    }
}
