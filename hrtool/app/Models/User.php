<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Family_Member;

class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'employee_number',
        'first_name',
        'last_name',
        'name_of_one_parent',
        'birth_date',
        'jmbg',
        'ID_number',
        'passport_number',
        'address_in_ID',
        'current_address',
        'slava',
        'private_email',
        'mobile',
        'bank_account_number',
        'emergency_contact_name',
        'emergency_contact_number',
        'family_members_id',
        'manager',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function familyMember()
    {
        return $this->belongsTo(Family_Member::class, 'family_members_id');
    }
}
