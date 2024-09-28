<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'debtor_id', 'currency_id', 'amount'];

    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Debtor model
    public function debtor()
    {
        return $this->belongsTo(Debtor::class);
    }

    // Relationship with Currency model
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
