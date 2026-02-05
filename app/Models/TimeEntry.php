<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeEntry extends Model
{
   protected $fillable = [
        'user_id', 'project', 'task', 'minutes', 'date', 'status'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function getDurationAttribute()
    {
        $h = intdiv($this->minutes, 60);
        $m = $this->minutes % 60;
        return "{$h}h {$m}m";
    }
}
