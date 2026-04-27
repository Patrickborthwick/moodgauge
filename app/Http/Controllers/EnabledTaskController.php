<?php

namespace App\Http\Controllers;

use App\Models\EnabledTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnabledTaskController extends Controller
{
    public function store(Request $request)
    {
        $existing = EnabledTask::where('user_id', Auth::id())
            ->where('task_id', $request->task_id)
            ->first();

        if ($existing) {
            $existing->delete();
            return response()->json(['status' => 'disabled']);
        }

        EnabledTask::create([
            'user_id' => Auth::id(),
            'task_id' => $request->task_id,
        ]);

        return response()->json(['status' => 'enabled']);
    }
}
