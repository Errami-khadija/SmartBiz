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

    if ($completed === 0) {
        return 'just_started';
    }

    if ($completed === $total) {
        return 'completed';
    }

    return 'in_progress';
}

public function getStatusColorAttribute()
{
    return match ($this->status) {
        'completed'   => 'bg-emerald-100 text-emerald-700',
        'in_progress' => 'bg-blue-100 text-blue-700',
        default       => 'bg-yellow-100 text-yellow-700',
    };
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
