<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Family_Member;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{

    var $familyMembers = [];
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function show(Request $request): View
    {
        return view('profile.index', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    /*
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.show')->with('status', 'profile-updated');
    }
*/


    public function update(Request $request)
    {
        $request->validate([


            'name_of_one_parent' => 'required',
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

        $user = User::find(Auth::user()->id);

        $user->name_of_one_parent = $request->input('name_of_one_parent');
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

        $user->save();

        return redirect('/profile')->with('success', 'Profile updated successfully!');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    public function addFamilyMembers(Request $request)
    {
        //$familyMembers = []; // define and initialize the array
        
        //$familyMembers = $request->input('familyMembers');
        //$familyMembers = json_decode($request->input('familyMembers'), true);
        // The second argument `true` is passed to convert the JSON string to an associative array.


        $familyMembers = $request->input('familyMembers');


        // Check if $familyMembers is not null
        if (!is_null($familyMembers)) {
            $user = Auth::user();

            foreach ($familyMembers as $member) {
                $familyMember = new Family_Member();
                $familyMember->relationship = $member['relationship'];
                $familyMember->jmbg = $member['jmbg'];
                $familyMember->name = $member['name'];
                $familyMember->birth_date = $member['birth_date'];
                $familyMember->user_id = $user->id;
                $familyMember->save();
            }

            return redirect()->back()->with('success', 'Family members added successfully.');
        } else {
            return redirect()->back()->with('error', 'No family members found in the request.');
        }
    }

}
