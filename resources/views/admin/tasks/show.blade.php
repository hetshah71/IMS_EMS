<x-dashboard-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Task Details</h2>

                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-700">Title:</h3>
                        <p class="text-gray-900 text-base">{{ $task->title }}</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-700">Description:</h3>
                        <p class="text-gray-900 text-base">{{ $task->description }}</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-700">Status:</h3>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                            @if($task->status === 'completed') bg-green-100 text-green-800
                            @elseif($task->status === 'in_progress') bg-yellow-100 text-yellow-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ str_replace('_', ' ', ucfirst($task->status)) }}
                        </span>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('tasks.index') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Back to Tasks
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
