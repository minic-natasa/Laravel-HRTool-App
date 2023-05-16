<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annex extends Model
{
    use HasFactory;

    protected $fillable = [

        'reason',
        'old_gross_salary',
        'gross_salary',
        'old_position',
        'position',
        'old_address_of_work',
        'address_of_work',
        'old_address_of_employer',
        'address_of_employer',
        'old_working_hours',
        'working_hours',
        'annex_date',
        'annex_created_date',
        'deleted',
        'contract_id',
    ];

    public function contract() //One annex belongs to one contract
    {
        return $this->belongsTo(Contract::class);
    }
}
