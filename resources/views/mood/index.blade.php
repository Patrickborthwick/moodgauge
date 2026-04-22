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

    <div class="calendar-container border-colour-gradient p-5 m-5">
        <!-- Navigation -->
        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('mood.index', ['month' => $prevMonth, 'year' => $prevYear]) }}"
                class="px-4 py-2 text-sm text-gray-200 border border-gray-200 rounded-lg hover:bg-gray-50">
                &larr; Previous
            </a>

            <h2 class="text-lg font-medium text-gray-200">
                {{ Carbon::create($year, $month)->format('F Y') }}
            </h2>

            <a href="{{ route('mood.index', ['month' => $nextMonth, 'year' => $nextYear]) }}"
                class="px-4 py-2 text-sm text-gray-200 border border-gray-200 rounded-lg hover:bg-gray-50">
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

        <!-- Day cells -->
        @for ($day = 1; $day <= $daysInMonth; $day++)
            @php
            $dateKey=sprintf('%04d-%02d-%02d', $year, $month, $day);
            $entry=$calendarDays[$dateKey] ?? null;
            $mood=$entry?->mood;
            $isToday = $dateKey === $todayKey;
            $icon = $mood ? Storage::url($mood->mood_icon) : Storage::url('moods/emptyDay.png');
            $alt = $mood ? $mood->mood_label : 'empty day';
            $isFuture = Carbon::parse($dateKey)->isFuture();
            @endphp

            <div class="calendar-day">
                @if (!$isFuture)
                <div class="calendar-day cursor-pointer day-image rounded-full overflow-hidden {{ $isFuture ? 'opacity-40 cursor-not-allowed' : 'cursor-pointer' }} {{ $isToday ? 'ring-colour' : '' }}"
                    onclick="openModal('{{ $dateKey }}', '{{ Carbon::parse($dateKey)->format('d F Y') }}')">
                    <img class="" src="{{ $icon }}" alt="{{ $alt }}">
                    @else
                    <div class="calendar-day opacity-40 cursor-not-allowed">
                        <img class="" src="{{ $icon }}" alt="{{ $alt }}">
                        @endif
                    </div>
                    <p class="text-center text-xs text-gray-400">{{ $day }}</p>
                </div>
                @endfor

            </div>
    </div>
    
    <div id="mood-modal" class="flex hidden fixed inset-0 bg-black/60 z-50  items-center justify-center">
        <div class="border-colour-gradient p-6 w-80 relative">

            <button onclick="closeModal()" class="absolute top-3 right-4 text-gray-400 text-xl">&times;</button>

            <h2 class="text-white text-center font-semibold mb-4" id="modal-date-label"></h2>

            <form action="{{ route('mood.store') }}" method="POST">
                @csrf
                <input type="hidden" name="calendar_day_date" id="modal-date-input">

                <div class="grid grid-cols-5 gap-3 mb-6">
                    @foreach ($moods as $mood)
                    <label class="flex flex-col items-center cursor-pointer">
                        <input type="radio" name="mood_id" value="{{ $mood->id }}" class="hidden peer">
                        <img src="{{ Storage::url($mood->mood_icon) }}" alt="{{ $mood->mood_label }}"
                            class="w-12 h-12 rounded-full peer-checked:ring-2 peer-checked:ring-blue-400">
                    </label>
                    @endforeach
                </div>

                <button type="submit" class="w-full py-2 rounded-full text-white font-semibold ring-rainbow">
                    Save
                </button>
            </form>
        </div>
    </div>
    <div class="footer w-full h-15 border-footer fixed flex items-center justify-center absolute inset-x-0 bottom-0">
        <button onclick="openModal('{{ now()->format('Y-m-d') }}', 'Today')"
            class="flex items-center justify-center w-25 h-25 -translate-y-6 rounded-full bottom-10 text-white text-3xl border-colour">
            <img src="{{ Storage::url("moods/emptyDay.png") }}" alt="add todays mood">
        </button>
    </div>

</x-layout>
<script>
    function openModal(date, label) {
        document.getElementById('modal-date-input').value = date;
        document.getElementById('modal-date-label').textContent = label;
        document.getElementById('mood-modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('mood-modal').classList.add('hidden');
    }
</script>