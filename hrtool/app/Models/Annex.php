<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annex extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
    ];

    public function contracts() //One annex belongs to one contract
    {
        return $this->belongsTo(Contract::class);
    }
}
