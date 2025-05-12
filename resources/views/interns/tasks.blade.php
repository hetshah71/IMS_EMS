<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-1">Your Tasks</h1>
                    <p class="text-gray-400">View and track your assigned tasks</p>
                </div>
            </div>

            <!-- Task List Section -->
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg border border-gray-700">
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 pb-4 border-b border-gray-700">
                        <h2 class="text-xl font-semibold text-gray-200 mb-3 sm:mb-0">All Tasks</h2>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-400">{{ count($tasks) }} tasks total</span>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-700 rounded-lg overflow-hidden">
                            <thead class="bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3.5 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Title
                                    </th>
                                    <th scope="col" class="px-6 py-3.5 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3.5 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Due Date
                                    </th>
                                    <th scope="col" class="px-6 py-3.5 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Description
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-800 divide-y divide-gray-700">
                                @forelse ($tasks as $task)
                                <tr class="hover:bg-gray-750 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-100">{{ $task->name ?? $task->title }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($task->status === 'completed') bg-green-100 text-green-800
                                                @elseif($task->status === 'in_progress') bg-yellow-100 text-yellow-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-300">
                                            {{ $task->due_date ? $task->due_date->format('M d, Y') : ($task->created_at ? $task->created_at->format('M d, Y') : '-') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-normal max-w-xs">
                                        <div class="text-sm text-gray-400">{{ $task->description }}</div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 whitespace-nowrap text-sm text-gray-400 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-500 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <p>No tasks found.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination (if using pagination) -->
                    @if(method_exists($tasks, 'links'))
                    <div class="mt-6">
                        {{ $tasks->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>