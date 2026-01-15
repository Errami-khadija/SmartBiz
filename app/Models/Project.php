<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Client;

class Project extends Model
{
     protected $fillable = [
        'client_id',
        'name',
        'description',
        'status',
        'start_date',
        'end_date',
        'budget'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
