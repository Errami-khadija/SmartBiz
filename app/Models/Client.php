<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Project;

class Client extends Model
{
     protected $fillable = [
        'name',
        'email',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    // Active projects count 
    public function activeProjects()
    {
        return $this->projects()->where('status', 'in_progress');
    }
}
