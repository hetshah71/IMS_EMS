<x-app-layout>
    <div class="py-6 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header with welcome message -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-white">Intern Dashboard</h1>
                    <p class="text-gray-400">Welcome back, {{ $intern->user->name }}! Here's your overview.</p>
                </div>
                <div class="mt-4 md:mt-0 flex space-x-3">
                    <a href="{{ route('intern.tasks.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg inline-flex items-center transition-all duration-200 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        My Tasks
                    </a>
                    <a href="{{ route('intern.chat.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg inline-flex items-center transition-all duration-200 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        Messages
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
                <!-- Intern Profile Card -->
                <div class="bg-gray-800 shadow rounded-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-4">
                        <h2 class="text-xl font-semibold text-white">Profile Information</h2>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="bg-blue-900 rounded-full p-3 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-white">{{ $intern->user->name }}</h3>
                                <p class="text-gray-400 text-sm">Intern</p>
                            </div>
                        </div>
                        <div class="space-y-3 mt-6">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="text-gray-300">{{ $intern->user->email }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                <span class="text-gray-700">{{ $intern->department }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Task Statistics Card -->
                <div class="bg-gray-800 shadow rounded-lg overflow-hidden">
                    <div class="bg-gradient-to-r from-green-600 to-teal-700 px-6 py-4">
                        <h2 class="text-xl font-semibold text-white">Task Statistics</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gray-700 rounded-lg p-4 text-center">
                                <span class="text-3xl font-bold text-blue-400">{{ $intern->tasks->count() }}</span>
                                <p class="text-gray-300 mt-1">Total Tasks</p>
                            </div>
                            <div class="bg-gray-700 rounded-lg p-4 text-center">
                                <span class="text-3xl font-bold text-green-400">{{ $intern->tasks->where('status', 'completed')->count() }}</span>
                                <p class="text-gray-300 mt-1">Completed</p>
                            </div>
                        </div>
                        <div class="mt-6">
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-3">Recent Activity</h3>
                            <div class="space-y-3">
                                @forelse($intern->tasks->sortByDesc('updated_at')->take(3) as $recentTask)
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full {{ $recentTask->status == 'completed' ? 'bg-green-100 text-green-600' : 'bg-blue-100 text-blue-600' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-800">{{ $recentTask->title }}</p>
                                        <p class="text-xs text-gray-500">{{ $recentTask->updated_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                @empty
                                <p class="text-gray-500 text-sm">No recent activity</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Assigned Tasks Card -->
                <div class="bg-gray-800 shadow rounded-lg overflow-hidden lg:col-span-1">
                    <div class="bg-gradient-to-r from-purple-600 to-pink-700 px-6 py-4">
                        <h2 class="text-xl font-semibold text-white">Assigned Tasks</h2>
                    </div>
                    <div class="p-6">
                        @if ($intern->tasks->isEmpty())
                        <div class="text-center py-8">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <p class="text-gray-600">No tasks assigned yet.</p>
                            <p class="text-gray-500 text-sm mt-1">Check back later for new assignments.</p>
                        </div>
                        @else
                        <div class="space-y-4 max-h-96 overflow-y-auto pr-2">
                            @foreach ($intern->tasks as $task)
                            <div class="border border-gray-700 rounded-lg p-4 hover:bg-gray-700 transition-colors">
                                <div class="flex justify-between items-start">
                                    <h3 class="text-md font-semibold text-white">{{ $task->title }}</h3>
                                    <span class="px-2 py-1 text-xs rounded-full {{ $task->status == 'completed' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ ucfirst($task->status) }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-400 mt-2">{{ $task->description }}</p>

                                <!-- Display comments for this task -->
                                @if($task->comments->isNotEmpty())
                                <div class="mt-3 pt-3 border-t border-gray-700">
                                    <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Comments ({{ $task->comments->count() }})</h4>
                                    <div class="space-y-2 max-h-32 overflow-y-auto">
                                        @foreach($task->comments->sortByDesc('created_at')->take(2) as $comment)
                                        <div class="text-sm text-gray-300 bg-gray-700 rounded p-2">
                                            <div class="flex justify-between items-center mb-1">
                                                <span class="font-medium text-gray-700">{{ $comment->user->name }}</span>
                                                <span class="text-xs text-gray-500">
                                                    {{ $comment->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                            <p>{{ $comment->content }}</p>
                                        </div>
                                        @endforeach
                                        @if($task->comments->count() > 2)
                                        <p class="text-xs text-center text-indigo-600 hover:text-indigo-800 cursor-pointer">View all comments</p>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>