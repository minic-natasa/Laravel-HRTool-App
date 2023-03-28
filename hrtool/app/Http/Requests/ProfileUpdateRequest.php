<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            
            'name_of_one_parent' => 'required',
            'birth_date' => 'required',
            'address_in_ID' => 'required',
            'current_address' => 'required',
            'slava' => 'required',
            'private_email' => 'required|email',
            'mobile' => 'required',
            'bank_account_number' => 'required',
            'emergency_contact_name' => 'required',
            'jmbg' => 'required',
            'manager' => 'required',
            'passport_number' => 'required',
            'employee_number' => 'required',
            'ID_number' => 'required',
            
        ];
    }
}
