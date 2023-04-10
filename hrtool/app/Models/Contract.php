<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'position',
        'organization_id',
        'employee_number',
        'type_of_contract',
        'contract_number',
        'contract_duration',
        'net_salary',
        'gross_salary_1',
        'gross_salary_2',
        'location_of_work',
        'transportation',
        'professional_qualifications_level',
        'professional_requirements_per_job_systematisation',
        'status',
        'annex_id',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_number');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function annex() //Contract has many annexes
    {
        return $this->hasMany(Annex::class, 'annex_id');
    }
}
