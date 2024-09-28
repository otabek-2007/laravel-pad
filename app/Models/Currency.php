<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code'];

    // Relationship with Payment model
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
