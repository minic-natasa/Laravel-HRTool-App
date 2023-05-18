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
use PHPUnit\Framework\Constraint\RegularExpression;


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
        $user = $request->user();
        $familyMembers = $user->familyMembers()->get();

        return view('profile.index', [
            'user' => $user,
            'familyMembers' => $familyMembers,
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
            'birth_date' => 'required',
            'address_in_ID' => 'required',
            'current_address' => 'required',
            'slava' => 'required',
            'private_email' => 'required|email',
            'mobile' => 'required',
            'bank_account_number' => 'required',
            'emergency_contact_name' => 'required',
            'emergency_contact_number' => 'required',
            'jmbg' => 'required',
            'passport_number' => 'required',
            'ID_number' => 'required',
            'employee_number' => 'required',
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

        // if($request->file('profile_picture')){
        //         $file = $request->file('profile_picture');
        //        $filename = date('YmdHi').$file->getClientOriginalName();
        //         $file->move(public_path('upload/admin_images'), $filename);
        //         $user['profile_picture'] = $filename;
        // }

        $user->save();

        $notification = array(
            'message' => 'Profile updated successfully!',
            'alert-type' => 'success'
        );

        return redirect('/profile')->with($notification);
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

        // Log the request data
        error_log('Request Data: ' . print_r($request->all(), true));

        $members = $request->input('familyMembers'); // Get the array of family members

        // Check if $members is not null and not empty
        if (!is_null($members) && count($members) > 0) {
            $user = Auth::user();

            foreach ($members as $member) {
                $familyMember = new Family_Member();
                $familyMember->relationship = $member['relationship'];
                $familyMember->jmbg = $member['jmbg'];
                $familyMember->name = $member['name'];
                $familyMember->birth_date = $member['birth_date'];
                $familyMember->user_id = $user->id;
                $familyMember->save();
            }

            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => 'No family member found in the request.'], 400);
        }
    }

    public function updateFamilyMembers(Request $request)
    {
        $familyMembersData = $request->input('familyMembers');

        foreach ($familyMembersData as $memberData) {
            if (isset($memberData['id'])) {
                // Update the existing family member
                $familyMember = Family_Member::find($memberData['id']);
            } else {
                // Create a new family member
                $familyMember = new Family_Member();
            }

            $familyMember->relationship = $memberData['relationship'];
            $familyMember->name = $memberData['name'];
            $familyMember->birth_date = $memberData['birth_date'];
            $familyMember->jmbg = $memberData['jmbg'];
            $familyMember->user_id = Auth::user()->id;
            $familyMember->save();
        }

        return response()->json(['message' => 'Family members updated successfully']);
    }


    public function deleteFamilyMember($id)
    {
        $familyMember = Family_Member::find($id);

        if (!$familyMember) {
            return response()->json(['error' => 'Family member not found.'], 404);
        }

        $familyMember->delete();

        return response()->json(['message' => 'Family member deleted successfully']);
    }
}
