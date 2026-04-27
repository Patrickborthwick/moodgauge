<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['task_name', 'task_icon_image', 'task_description'];

    public function enabledTasks()
    {
        return $this->hasMany(EnabledTask::class);
    }

    public function completedTasks()
    {
        return $this->hasMany(CompletedTask::class);
    }
}
