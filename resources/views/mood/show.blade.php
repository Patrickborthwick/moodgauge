<x-layout>



    @if ($entry)
        <div class=" border-colour-gradient p-5 m-5">
            <div class="flex items-center gap-2 mb-1">
                <img src="{{ Storage::url($entry->mood->mood_icon) }}" alt="{{ $entry->mood->mood_label }}"
                    class="w-5 h-5 rounded-full">
                <p class="text-xs text-gray-400">Today's reflection</p>
            </div>
            <p class="text-white text-sm leading-relaxed">{{ $entry->calendar_day_ai_summary_text }}</p>
        </div>
    @else
        <div class=" border-colour-gradient p-5 m-5">
            <p class="text-gray-400 text-sm text-center">Log today's mood to get your daily reflection</p>
        </div>
    @endif
    @if ($entry->completedTasks->count() > 0)
        <div class="border-colour-gradient p-5 m-5">
            <p class="text-xs text-gray-400 mb-3">Tasks completed</p>
            @foreach ($entry->completedTasks as $completedTask)
                <div class="flex items-center gap-2 mb-2">
                    <div class="w-2 h-2 rounded-full bg-green-500"></div>
                    <p class="text-white text-sm">{{ $completedTask->task->task_name }}</p>
                </div>
            @endforeach
        </div>
    @endif

    <div class="footer w-full h-15 border-footer fixed flex items-center justify-center inset-x-0 bottom-0">
        <div class="flex items-center justify-center  -translate-y-6 rounded-full">
            <a href="{{ route('mood.index') }}">
                <div class="border-colour-gradient p-4 text-2xl text-white text-center">
                    <p>Back to the Calendar</p>
                </div>
            </a>
        </div>
    </div>
</x-layout>