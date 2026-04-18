@php
    use Carbon\Carbon;

    $prevMonth = $month === 1 ? 12 : $month - 1;
    $prevYear = $month === 1 ? $year - 1 : $year;
    $nextMonth = $month === 12 ? 1 : $month + 1;
    $nextYear = $month === 12 ? $year + 1 : $year;

    $firstDayOfWeek = Carbon::create($year, $month, 1)->dayOfWeek;
    $offset = $firstDayOfWeek === 0 ? 6 : $firstDayOfWeek - 1;
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $todayKey = now()->format('Y-m-d');
@endphp
<x-layout>


    <!-- Navigation -->
    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('mood.index', ['month' => $prevMonth, 'year' => $prevYear]) }}"
            class="px-4 py-2 text-sm text-gray-500 border border-gray-200 rounded-lg hover:bg-gray-50">
            &larr; Previous
        </a>

        <h2 class="text-lg font-medium text-gray-800">
            {{ Carbon::create($year, $month)->format('F Y') }}
        </h2>

        <a href="{{ route('mood.index', ['month' => $nextMonth, 'year' => $nextYear]) }}"
            class="px-4 py-2 text-sm text-gray-500 border border-gray-200 rounded-lg hover:bg-gray-50">
            Next &rarr;
        </a>
    </div>

    <!-- Calendar grid  -->
    <div class="grid grid-cols-7 gap-2">

        <!--  Day headers  -->
        @foreach (['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $dayName)
            <div class="text-center text-xs font-medium text-gray-400 uppercase tracking-wide pb-2">
                {{ $dayName }}
            </div>
        @endforeach

        <!-- Offset empty cells  -->
        @for ($i = 0; $i < $offset; $i++)
            <div>
            </div>
        @endfor

        <!-- Day cells  -->
        @for ($day = 1; $day <= $daysInMonth; $day++)
            @php
                $dateKey = sprintf('%04d-%02d-%02d', $year, $month, $day);
                $entry = $calendarDays[$dateKey] ?? null;
                $mood = $entry?->mood;
                $isToday = $dateKey === $todayKey;
            @endphp

            <div class="relative aspect-square flex flex-col items-center justify-center rounded-lg border text-sm
                                        {{ $isToday ? 'border-blue-400' : 'border-gray-100' }}
                                        {{ $mood ? 'bg-white' : 'bg-gray-50' }}">

                <span class="absolute top-1 left-2 text-xs text-gray-400">{{ $day }}</span>

                @if ($mood)
                    <img src="{{ Storage::url($mood->mood_icon) }}" alt="{{ $mood->mood_label }}"> <span class="text-xs mt-0.5"
                        style="color:  <?= $mood->mood_label_colour  ?> ">
                        {{ $mood->mood_label }}
                    </span>
                @endif
            </div>
        @endfor

    </div>
</x-layout>