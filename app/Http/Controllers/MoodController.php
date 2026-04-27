<?php

namespace App\Http\Controllers;

use App\Models\CalendarDay;
use App\Models\CompletedTask;
use App\Models\EnabledTask;
use App\Models\Mood;
use App\Models\Task;
use App\Services\AiSummaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MoodController extends Controller
{
    public function index(Request $request)
    {
        $month = (int) $request->get('month', now()->month);
        $year  = (int) $request->get('year',  now()->year);
        $moods = Mood::all();

        if ($month < 1) {
            $month = 12;
            $year--;
        }
        if ($month > 12) {
            $month = 1;
            $year++;
        }

        $calendarDays = CalendarDay::with('mood')
            ->where('user_id', Auth::id())
            ->whereMonth('calendar_day_date', $month)
            ->whereYear('calendar_day_date', $year)
            ->get()
            ->keyBy(fn($day) => Carbon::parse($day->calendar_day_date)->format('Y-m-d'));

        $todayEntry = CalendarDay::with('mood')
            ->where('user_id', Auth::id())
            ->where('calendar_day_date', now()->format('Y-m-d'))
            ->first();

        $enabledTasks = EnabledTask::with('task')
            ->where('user_id', Auth::id())
            ->get();

        return view('mood.index', [
            'calendarDays' => $calendarDays,
            'month'        => $month,
            'year'         => $year,
            'moods'        => $moods,
            'todayEntry'   => $todayEntry,
            'enabledTasks' => $enabledTasks,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'mood_id'           => 'required|exists:moods,id',
            'calendar_day_date' => 'required|date|before_or_equal:today',
        ]);

        $recentMoods = CalendarDay::with('mood')
            ->where('user_id', Auth::id())
            ->orderBy('calendar_day_date', 'desc')
            ->take(30)
            ->get()
            ->map(fn($day) => [
                'date' => Carbon::parse($day->calendar_day_date)->format('Y-m-d'),
                'mood' => $day->mood->mood_label,
            ])
            ->toArray();

        $todayMood = Mood::find($request->mood_id);
        array_unshift($recentMoods, [
            'date' => $request->calendar_day_date,
            'mood' => $todayMood->mood_label,
        ]);

        $lastEntry = CalendarDay::where('user_id', Auth::id())
            ->whereNotNull('calendar_day_ai_summary_text')
            ->orderBy('calendar_day_date', 'desc')
            ->first();

        $lastSummary = $lastEntry?->calendar_day_ai_summary_text;

        $completedTaskNames = [];
        if ($request->has('completed_tasks')) {
            $completedTaskNames = Task::whereIn('id', $request->completed_tasks)
                ->pluck('task_name')
                ->toArray();
        }

        $summary = (new AiSummaryService)->generateSummary($recentMoods, $lastSummary, $completedTaskNames);

        $calendarDay = CalendarDay::create([
            'user_id'                      => Auth::id(),
            'mood_id'                      => $request->mood_id,
            'calendar_day_date'            => $request->calendar_day_date,
            'calendar_day_ai_summary_text' => $summary,
        ]);

        // Save completed tasks
        if ($request->has('completed_tasks')) {
            foreach ($request->completed_tasks as $taskId) {
                CompletedTask::create([
                    'task_id'         => $taskId,
                    'calendar_day_id' => $calendarDay->id,
                ]);
            }
        }

        return redirect()->route('mood.index');
    }
    public function create() {}
    public function show(Request $request)
    {
        $date = $request->get('date');
        $entry = CalendarDay::with('mood', 'completedTasks.task')
            ->where('user_id', Auth::id())
            ->where('calendar_day_date', $date)
            ->firstOrFail();

        return view('mood.show', [
            'entry' => $entry,
        ]);
    }
}
