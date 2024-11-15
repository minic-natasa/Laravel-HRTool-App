<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Family_Member extends Model
{
    use HasFactory;

    protected $table = 'family_members';

    protected $fillable = [
        'relationship',
        'name',
        'birth_date',
        'jmbg',
        'user_id',
    ];

        public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function familyMembers()
    {
    return $this->hasMany(FamilyMember::class);
    }
        
}
