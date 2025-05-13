<x-dashboard-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header with welcome message -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-extrabold text-white mb-1">Admin Dashboard</h1>
                    <p class="text-gray-400">Welcome back! Here's what's happening with your interns and tasks.</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('tasks.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg inline-flex items-center transition-all duration-200 shadow-lg">
                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Create New Task
                    </a>
                </div>
            </div>

            <!-- Stats Overview Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                <!-- Total Interns Card -->
                <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl shadow-xl overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                    <div class="px-6 py-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-800 rounded-xl p-3 shadow-inner">
                                <svg class="h-8 w-8 text-blue-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="ml-5">
                                <p class="text-sm font-medium text-blue-200">Total Interns</p>
                                <div class="flex items-baseline">
                                    <p class="text-4xl font-extrabold text-white">{{ $totalInterns }}</p>
                                    <p class="ml-2 text-sm text-blue-300">active members</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 border-t border-blue-700 pt-3">
                            <a href="{{ route('interns.index') }}" class="text-blue-200 hover:text-white text-sm font-medium flex items-center transition-colors duration-200">
                                View all interns
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Total Admins Card -->
                <div class="bg-gradient-to-br from-red-600 to-red-800 rounded-2xl shadow-xl overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                    <div class="px-6 py-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-red-800 rounded-xl p-3 shadow-inner">
                                <svg class="h-8 w-8 text-red-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div class="ml-5">
                                <p class="text-sm font-medium text-red-200">Total Admins</p>
                                <div class="flex items-baseline">
                                    <p class="text-4xl font-extrabold text-white">{{ $totalAdmins }}</p>
                                    <p class="ml-2 text-sm text-red-300">system managers</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 border-t border-red-700 pt-3">
                            <a href="{{ route('admins.index') }}" class="text-red-200 hover:text-white text-sm font-medium flex items-center transition-colors duration-200">
                                View all admins
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Total Tasks Card -->
                <div class="bg-gradient-to-br from-emerald-600 to-emerald-800 rounded-2xl shadow-xl overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                    <div class="px-6 py-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-emerald-800 rounded-xl p-3 shadow-inner">
                                <svg class="h-8 w-8 text-emerald-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                            </div>
                            <div class="ml-5">
                                <p class="text-sm font-medium text-emerald-200">Total Tasks</p>
                                <div class="flex items-baseline">
                                    <p class="text-4xl font-extrabold text-white">{{ $totalTasks }}</p>
                                    <p class="ml-2 text-sm text-emerald-300">assigned tasks</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 border-t border-emerald-700 pt-3">
                            <a href="{{ route('tasks.index') }}" class="text-emerald-200 hover:text-white text-sm font-medium flex items-center transition-colors duration-200">
                                View all tasks
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Task Status Section -->
            <div class="bg-gray-800 rounded-2xl shadow-xl p-6 mb-10 border border-gray-700">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                    <h2 class="text-2xl font-bold text-white">Task Status Overview</h2>
                    <div class="mt-3 md:mt-0 text-sm font-medium text-gray-400">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-indigo-100 text-indigo-800">
                            <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-indigo-400" fill="currentColor" viewBox="0 0 8 8">
                                <circle cx="4" cy="4" r="3" />
                            </svg>
                            Last updated: Today
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Completed Tasks Card -->
                    <div class="bg-gray-900 rounded-xl p-5 border-l-4 border-yellow-500 shadow-md hover:shadow-lg transition-shadow duration-300">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-gray-400">Completed Tasks</p>
                                <p class="text-3xl font-bold text-white mt-1">{{ $totalCompletedTasks }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $totalTasks > 0 ? round(($totalCompletedTasks / $totalTasks) * 100) : 0 }}% of total tasks</p>
                            </div>
                            <div class="bg-yellow-500 bg-opacity-20 rounded-full p-3">
                                <svg class="h-7 w-7 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="w-full bg-gray-700 rounded-full h-2.5">
                                <div class="bg-yellow-500 h-2.5 rounded-full" data-width="{{ $totalTasks > 0 ? ($totalCompletedTasks / $totalTasks) * 100 : 0 }}"></div>
                            </div>
                        </div>
                    </div>

                    <!-- In Progress Tasks Card -->
                    <div class="bg-gray-900 rounded-xl p-5 border-l-4 border-purple-500 shadow-md hover:shadow-lg transition-shadow duration-300">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-gray-400">In Progress Tasks</p>
                                <p class="text-3xl font-bold text-white mt-1">{{ $totalInProgressTasks }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $totalTasks > 0 ? round(($totalInProgressTasks / $totalTasks) * 100) : 0 }}% of total tasks</p>
                            </div>
                            <div class="bg-purple-500 bg-opacity-20 rounded-full p-3">
                                <svg class="h-7 w-7 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="w-full bg-gray-700 rounded-full h-2.5">
                                <div class="bg-purple-500 h-2.5 rounded-full" data-width="{{ $totalTasks > 0 ? ($totalInProgressTasks / $totalTasks) * 100 : 0 }}"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Tasks Card -->
                    <div class="bg-gray-900 rounded-xl p-5 border-l-4 border-blue-500 shadow-md hover:shadow-lg transition-shadow duration-300">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-gray-400">Pending Tasks</p>
                                <p class="text-3xl font-bold text-white mt-1">{{ $totalPendingTasks }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $totalTasks > 0 ? round(($totalPendingTasks / $totalTasks) * 100) : 0 }}% of total tasks</p>
                            </div>
                            <div class="bg-blue-500 bg-opacity-20 rounded-full p-3">
                                <svg class="h-7 w-7 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="w-full bg-gray-700 rounded-full h-2.5">
                                <div class="bg-blue-500 h-2.5 rounded-full" data-width="{{ $totalTasks > 0 ? ($totalPendingTasks / $totalTasks) * 100 : 0 }}"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Section -->
            <div class="bg-gray-800 rounded-2xl shadow-xl p-6 border border-gray-700">
                <h2 class="text-2xl font-bold text-white mb-6">Quick Actions</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    <a href="{{ route('tasks.create') }}" class="group bg-gradient-to-br from-indigo-500 to-indigo-700 hover:from-indigo-600 hover:to-indigo-800 text-white rounded-xl p-5 flex flex-col items-center justify-center shadow-lg transition duration-300 transform hover:scale-105 hover:shadow-xl">
                        <div class="bg-white bg-opacity-20 rounded-full p-3 mb-3 group-hover:bg-opacity-30 transition-all duration-300">
                            <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <span class="font-semibold text-lg">Create New Task</span>
                        <span class="text-xs text-indigo-200 mt-1">Assign work to interns</span>
                    </a>

                    <a href="{{ route('interns.create') }}" class="group bg-gradient-to-br from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white rounded-xl p-5 flex flex-col items-center justify-center shadow-lg transition duration-300 transform hover:scale-105 hover:shadow-xl">
                        <div class="bg-white bg-opacity-20 rounded-full p-3 mb-3 group-hover:bg-opacity-30 transition-all duration-300">
                            <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                        <span class="font-semibold text-lg">Add New Intern</span>
                        <span class="text-xs text-blue-200 mt-1">Register a new intern</span>
                    </a>

                    <a href="{{ route('admins.create') }}" class="group bg-gradient-to-br from-red-500 to-red-700 hover:from-red-600 hover:to-red-800 text-white rounded-xl p-5 flex flex-col items-center justify-center shadow-lg transition duration-300 transform hover:scale-105 hover:shadow-xl">
                        <div class="bg-white bg-opacity-20 rounded-full p-3 mb-3 group-hover:bg-opacity-30 transition-all duration-300">
                            <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                        <span class="font-semibold text-lg">Add New Admin</span>
                        <span class="text-xs text-red-200 mt-1">Create admin account</span>
                    </a>

                    <a href="{{ route('tasks.index') }}" class="group bg-gradient-to-br from-emerald-500 to-emerald-700 hover:from-emerald-600 hover:to-emerald-800 text-white rounded-xl p-5 flex flex-col items-center justify-center shadow-lg transition duration-300 transform hover:scale-105 hover:shadow-xl">
                        <div class="bg-white bg-opacity-20 rounded-full p-3 mb-3 group-hover:bg-opacity-30 transition-all duration-300">
                            <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <span class="font-semibold text-lg">View All Tasks</span>
                        <span class="text-xs text-emerald-200 mt-1">Manage existing tasks</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('[data-width]').forEach(function(element) {
            element.style.width = element.dataset.width + '%';
        });
    });
</script>