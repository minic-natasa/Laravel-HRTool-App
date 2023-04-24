<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'first_day_on_job',
        'position',
        'organization_id',
        'employee_number',
        'type_of_contract',
        'contract_number',
        'contract_duration',
        'probationary_period',
        'net_salary',
        'gross_salary_1',
        'gross_salary_2',
        'location_of_work',
        'transportation',
        'status',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_number');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function annexes() //Contract has many annexes
    {
        return $this->hasMany(Annex::class);
    }
}
