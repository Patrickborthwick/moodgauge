<?php

namespace App\Http\Controllers;

use App\Models\CalendarDay;
use App\Models\Mood;
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
        return view('mood.index', [
            'moods' => $moods,
            'calendarDays' => $calendarDays,
            'month'        => $month,
            'year'         => $year,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'mood_id'           => 'required|exists:moods,id',
            'calendar_day_date' => 'required|date|before_or_equal:today',
        ]);

        CalendarDay::create([
            'user_id'                      => Auth::id(),
            'mood_id'                      => $request->mood_id,
            'calendar_day_date'            => $request->calendar_day_date,
            'calendar_day_ai_summary_text' => '',
        ]);

        return redirect()->route('mood.index');
    }
    public function create() {}
    public function show() {}
}
