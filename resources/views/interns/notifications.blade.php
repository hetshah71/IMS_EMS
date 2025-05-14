<x-app-layout>
    <div class="py-8 bg-gray-900 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header section -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-white">Notifications</h1>
                    <p class="text-gray-400">Stay updated with your latest notifications</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('intern.dashboard') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg inline-flex items-center transition-all duration-200 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Back to Dashboard
                    </a>
                </div>
            </div>

            <!-- Notifications container -->
            <div class="bg-gray-800 rounded-xl overflow-hidden shadow-xl border border-gray-700">
                <div class="border-b border-gray-700 px-6 py-4 bg-gray-800">
                    <h2 class="text-xl font-semibold text-white">Your Notifications</h2>
                </div>

                <div class="divide-y divide-gray-700">
                    @forelse($notifications as $notification)
                    <div class="p-6 hover:bg-gray-750 transition duration-150 flex items-start">
                        <!-- Notification icon -->
                        <div class="flex-shrink-0 mr-4">
                            <div class="rounded-full bg-blue-600 bg-opacity-20 p-3 text-blue-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                            </div>
                        </div>
                        <!-- Notification content -->
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <h3 class="text-lg font-medium text-white">
                                    {{ $notification->data['task']['title'] ?? 'Untitled Task' }}
                                </h3>
                                <div class="flex space-x-1">
                                    @if(!$notification->read_at)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        New
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <p class="text-gray-300 mb-2">
                                {{ $notification->data['message'] ?? 'You have a new task.' }}
                            </p>
                            <div class="flex items-center text-sm text-gray-400 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                
                                <span>From: {{ $notification->data['admin']['name'] ?? 'Unknown Admin' }}</span>
                                <span class="mx-2">•</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ $notification->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                @if(!$notification->read_at)
                                <a href="{{ route('intern.notifications.markAsRead', $notification->id) }}" class="inline-flex items-center text-sm font-medium text-blue-400 hover:text-blue-300 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Mark as read
                                </a>
                                @endif
                                <form method="POST" action="{{ route('intern.notifications.destroy', $notification->id) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this notification?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center text-sm font-medium text-red-400 hover:text-red-300 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-10 text-center">
                        <div class="inline-flex items-center justify-center rounded-full bg-gray-700 p-4 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-white mb-1">No notifications yet</h3>
                        <p class="text-gray-400">When you receive notifications, they'll appear here</p>
                    </div>
                    @endforelse
                </div>
            </div>

            @if(count($notifications) > 0)
            <div class="mt-6 flex justify-end">
                <form method="POST" action="{{ route('intern.notifications.clearAll') }}" class="inline" onsubmit="return confirm('Are you sure you want to clear all notifications?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Clear All Notifications
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>