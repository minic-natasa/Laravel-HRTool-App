<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Family_Member;
use App\Models\Contract;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable, HasRoles;

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
        'manager',
        'professional_qualifications_level',
        'profession',
        'status',

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
        return $this->hasMany(Family_Member::class);
    }

    public function familyMembers()
    {
        return $this->hasMany(Family_Member::class);
    }

    public function contract()
    {
        return $this->hasMany(Contract::class, 'employee_number');
    }


    public static function getPermissionGroups()
    {
        $permission_groups = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();
        return $permission_groups;
    }

    public static function getPermissionsForGroup($group_name)
    {
        $permissions = DB::table('permissions')->select('name', 'id')->where('group_name', $group_name)->get();
        return $permissions;
    }

    public static function roleHasPermissions($role, $permissions)
    {
        $hasPermission = true;
        foreach($permissions as $permission){
            if(!$role->hasPermissionTo($permission->name)){
                $hasPermission = false;
                return $hasPermission;
            }
           return $hasPermission;
        }
    }
}
