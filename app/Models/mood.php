<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mood extends Model
{

    protected $fillable = ['mood_label', 'mood_label_colour', 'mood_icon'];


    /** @use HasFactory<\Database\Factories\MoodFactory> */
    use HasFactory;
}
