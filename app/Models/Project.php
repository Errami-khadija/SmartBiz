<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Task;

class Project extends Model
{
     protected $fillable = [
        'client_id',
        'name',
        'description',
        'start_date',
        'end_date',
        'budget'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function tasks()
{
    return $this->hasMany(Task::class);
}

public function getStatusAttribute()
{
    $total = $this->tasks()->count();

    if ($total === 0) {
        return 'just_started';
    }

    $completed = $this->tasks()->where('status', 'done')->count();

    if ($completed === $total) {
        return 'completed';
    }

    return 'in_progress';
}

public function getProgressAttribute()
{
    $total = $this->tasks()->count();

    if ($total === 0) {
        return 0;
    }

    $completed = $this->tasks()->where('status', 'done')->count();

    return round(($completed / $total) * 100);
}

}
