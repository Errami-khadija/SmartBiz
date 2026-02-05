<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'user_id',
        'category',
        'item',
        'amount',
        'date',
        'notes',
    ];
    
    protected $casts = [
        'date' => 'date',
    ];
}
