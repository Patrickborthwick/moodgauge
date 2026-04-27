<?php

namespace App\Http\Controllers;

use App\Models\EnabledTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all()->groupBy('category');
        $enabledTaskIds = EnabledTask::where('user_id', Auth::id())
            ->pluck('task_id')
            ->toArray();

        return view('tasks.index', compact('tasks', 'enabledTaskIds'));
    }
}
