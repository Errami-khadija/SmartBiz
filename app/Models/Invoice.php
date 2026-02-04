<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
     use HasFactory;
 protected $fillable = [
        'user_id',
       'client_id',
        'invoice_id',
        'amount',
        'status',
        'invoice_date',
    ];

      protected $casts = [
        'invoice_date' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
