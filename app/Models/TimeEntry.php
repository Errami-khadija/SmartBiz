<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeEntry extends Model
{
protected $fillable = ['user_id', 'project_id', 'task_id', 'minutes'];


    protected $casts = [
        'date' => 'date',
    ];

    public function getDurationAttribute()
    {
        $h = intdiv($this->minutes, 60);
        $m = $this->minutes % 60;
        return "{$h}h {$m}m";
    }

    public function project()
{
    return $this->belongsTo(Project::class);
}

public function task()
{
    return $this->belongsTo(Task::class);
}

}
