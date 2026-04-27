<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompletedTask extends Model
{
    protected $fillable = ['task_id', 'calendar_day_id'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function calendarDay()
    {
        return $this->belongsTo(CalendarDay::class);
    }
}
