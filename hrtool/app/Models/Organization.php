<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'manager_id',
    ];

    public function parent()
    {
        return $this->belongsTo(Organization::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Organization::class, 'parent_id');
    }

    public function manager()
    {
        //return $this->belongsTo(User::class, 'manager_id')->where('manager', 1)->withDefault();
        //return $this->belongsTo(User::class, 'manager_id')->select('name')->where('manager', 1)->withDefault();
        //return $this->belongsTo(User::class, 'manager_id')->select('name')->where('manager', 1)->withDefault();
        return $this->belongsTo(User::class, 'manager_id')->select('first_name','last_name') ->where('manager', 1)->withDefault();
        //return $this->belongsTo(User::class, 'manager_id')->value('name') ?? null;
    }

    public function contract()
    {
        return $this->hasMany(Contract::class);
    }

    public function position()
    {
        return $this->hasMany(Position::class);
    }


}
