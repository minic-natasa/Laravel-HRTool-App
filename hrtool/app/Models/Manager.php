<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
    ];

    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }

    public function hasOrganization($organizationId)
    {
        foreach ($this->organizations as $organization) {
            if ($organization->id === $organizationId) {
                return true;
            }
        }

        return false;
    }
}