<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mood extends Model
{

    protected $fillable = ['mood_label', 'mood_label_colour', 'mood_icon'];


    /** @use HasFactory<\Database\Factories\MoodFactory> */
    use HasFactory;

    public function CalendarDays(){
        return $this->hasMany(CalendarDay::class);
    }
}
