<?php

namespace App\Http\Controllers;

use App\Models\CalendarDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MoodController extends Controller
{
    public function index(Request $request)
    {
        $month = (int) $request->get('month', now()->month);
        $year  = (int) $request->get('year',  now()->year);

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
            'calendarDays' => $calendarDays,
            'month'        => $month,
            'year'         => $year,
        ]);
    }

    public function store() {}

    public function create() {}
    public function show() {}
}
