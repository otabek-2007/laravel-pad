<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debtor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'user_id',
        'amount',
        'phone_number',
        'date_of_acceptance',
        'date_of_issue'
    ];
    public function user()
    {
        return $this->belongsTo(Auth::class);
    }
}
