<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annex extends Model
{
    use HasFactory;

    protected $fillable = [

        'reason',
        'old_value',
        'new_value',
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
