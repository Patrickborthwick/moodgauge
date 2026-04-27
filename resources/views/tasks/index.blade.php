<x-layout>
    <div class="p-5 m-5 mb-24">
        <h1 class="text-white text-lg font-semibold mb-1">Daily Tasks</h1>
        <p class="text-gray-400 text-xs mb-5">Select the tasks you want to track each day</p>

        @foreach ($tasks as $category => $categoryTasks)
            <div class="mb-6">
                <p class="text-gray-400 text-xs uppercase tracking-widest mb-3">{{ $category }}</p>
                @foreach ($categoryTasks as $task)
                    <div class="border-colour-gradient p-4 mb-3 flex items-center justify-between cursor-pointer task-toggle"
                        data-task-id="{{ $task->id }}">
                        <div>
                            <p class="text-white text-sm font-medium">{{ $task->task_name }}</p>
                            <p class="text-gray-400 text-xs mt-1">{{ $task->task_description }}</p>
                        </div>
                        <div class="w-10 h-6 rounded-full transition-colors duration-300 flex items-center px-1 flex-shrink-0 ml-3
                                                    {{ in_array($task->id, $enabledTaskIds) ? 'bg-green-500' : 'bg-gray-600' }}"
                            id="toggle-{{ $task->id }}">
                            <div class="w-4 h-4 rounded-full bg-white transition-transform duration-300
                                                        {{ in_array($task->id, $enabledTaskIds) ? 'translate-x-4' : '' }}">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <div class="footer w-full h-15 border-footer fixed flex items-center justify-center inset-x-0 bottom-0">
        <div class="flex items-center justify-center -translate-y-6 rounded-full">
            <a href="{{ route('mood.index') }}">
                <div class="border-colour-gradient p-4 text-2xl text-white text-center">
                    <p>Back to the Calendar</p>
                </div>
            </a>
        </div>
    </div>

    <script>
        document.querySelectorAll('.task-toggle').forEach(el => {
            el.addEventListener('click', () => {
                const taskId = el.dataset.taskId;
                const toggle = document.getElementById('toggle-' + taskId);
                const dot = toggle.querySelector('div');

                fetch('{{ route('tasks.toggle') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ task_id: taskId })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'enabled') {
                            toggle.classList.remove('bg-gray-600');
                            toggle.classList.add('bg-green-500');
                            dot.classList.add('translate-x-4');
                        } else {
                            toggle.classList.remove('bg-green-500');
                            toggle.classList.add('bg-gray-600');
                            dot.classList.remove('translate-x-4');
                        }
                    });
            });
        });
    </script>
</x-layout>