<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Family_Member;

class FamilyMemberController extends Controller
{
    //
    public function getFamilyMembers($profileId)
    {
        // Replace this line with your actual query to get family members from the database
        $familyMembers = Family_Member::where('user_id', $profileId)->get();;

        return response()->json($familyMembers);
    }
}
