<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200">

                    @if (session('status'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1 class="text-2xl font-bold text-gray-800 mb-6">Your Tasks</h1>

                    @forelse ($tasks as $task)
                        <div class="mb-4 p-4 border rounded-lg shadow-sm bg-gray-50">
                            <h2 class="text-lg font-semibold text-gray-700">{{ $task->name }}</h2>
                            <p class="text-gray-600 mt-1"><span class="font-medium">Description:</span>
                                {{ $task->description }}</p>
                            <p class="text-gray-600 mt-1">
                                <span class="font-medium">Status:</span>
                                <span class="inline-block px-2 py-1 rounded-full text-sm font-medium
                                        @if ($task->status === 'completed') bg-green-100 text-green-800
                                        @elseif ($task->status === 'in_progress') bg-yellow-100 text-yellow-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                </span>
                            </p>
                            <p class="text-gray-500 mt-1 text-sm">Created at:
                                {{ $task->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500">No tasks found.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>