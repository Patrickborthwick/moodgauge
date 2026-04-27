<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarDay extends Model
{
    protected $table = 'calendar_days';
    protected $casts = [
        'CalendarDay_date' => 'date',
    ];
    protected $fillable = ['calendar_day_date', 'calendar_day_ai_summary_text', 'mood_id', 'user_id'];
    /** @use HasFactory<\Database\Factories\CalendarDayFactory> */
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Mood()
    {
        return $this->belongsTo(Mood::class);
    }
    public function completedTasks()
    {
        return $this->hasMany(CompletedTask::class);
    }
}
