<?php

namespace Database\Seeders;

use App\Models\Mood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moods = [
            ['mood_label' => 'Great',   'mood_icon' => 'moods/great.png', 'mood_label_colour' => '#00bf63'],
            ['mood_label' => 'Good',     'mood_icon' => 'moods/good.png', 'mood_label_colour' => '#7ed857'],
            ['mood_label' => 'Neutral', 'mood_icon' => 'moods/neutral.png', 'mood_label_colour' => '#0cc0df'],
            ['mood_label' => 'Bad',    'mood_icon' => 'moods/bad.png', 'mood_label_colour' => '#ff751f'],
            ['mood_label' => 'Awful',   'mood_icon' => 'moods/awful.png', 'mood_label_colour' => '#ff3131'],
        ];

        foreach ($moods as $mood) {
            Mood::create($mood);
        }
    }
}
