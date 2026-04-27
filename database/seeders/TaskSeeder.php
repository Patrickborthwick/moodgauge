<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            ['task_name' => 'Exercise', 'task_icon_image' => 'tasks/exercise.png', 'task_description' => 'Get your body moving with at least 30 minutes of physical activity.', 'category' => 'Health & Wellness'],
            ['task_name' => 'Drink 8 Glasses of Water', 'task_icon_image' => 'tasks/water.png', 'task_description' => 'Stay hydrated throughout the day.', 'category' => 'Health & Wellness'],
            ['task_name' => 'Sleep 8 Hours', 'task_icon_image' => 'tasks/sleep.png', 'task_description' => 'Get a full night of restful sleep.', 'category' => 'Health & Wellness'],
            ['task_name' => 'Meditate', 'task_icon_image' => 'tasks/meditate.png', 'task_description' => 'Take 10 minutes to clear your mind.', 'category' => 'Mindfulness'],
            ['task_name' => 'Journal', 'task_icon_image' => 'tasks/journal.png', 'task_description' => 'Write down your thoughts and feelings for the day.', 'category' => 'Mindfulness'],
            ['task_name' => 'Deep Breathing', 'task_icon_image' => 'tasks/breathing.png', 'task_description' => 'Practice deep breathing exercises to reduce stress.', 'category' => 'Mindfulness'],
            ['task_name' => 'Read for 30 Minutes', 'task_icon_image' => 'tasks/read.png', 'task_description' => 'Read a book or article for at least 30 minutes.', 'category' => 'Productivity'],
            ['task_name' => 'No Social Media', 'task_icon_image' => 'tasks/nosocial.png', 'task_description' => 'Take a break from social media for the day.', 'category' => 'Productivity'],
            ['task_name' => 'Wake Up Early', 'task_icon_image' => 'tasks/early.png', 'task_description' => 'Start your day early and make the most of your morning.', 'category' => 'Productivity'],
        ];

        foreach ($tasks as $task) {
            \App\Models\Task::create($task);
        }
    }
}
