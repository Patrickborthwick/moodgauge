<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calendar_day extends Model
{

    protected $fillable = ['calendar_day_date', 'calendar_day_ai_summary_text', 'mood_id', 'user_id'];

    /** @use HasFactory<\Database\Factories\CalendarDayFactory> */
    use HasFactory;

    
}

