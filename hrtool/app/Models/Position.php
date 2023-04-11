<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'organization_id',
        'professional_qualifications_level',
        'professional_requirements_per_job_systematisation',
    ];


    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
