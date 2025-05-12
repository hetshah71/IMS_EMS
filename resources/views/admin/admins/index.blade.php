<x-dashboard-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-1">Admin Management</h1>
                    <p class="text-gray-400">Manage and track all system administrators</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('admins.create') }}"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 px-5 rounded-lg inline-flex items-center transition-all duration-200 shadow-lg">
                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Create New Admin
                    </a>
                </div>
            </div>

            <!-- Admin List Section -->
            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg border border-gray-700">
                <div class="p-6">
                    <!-- Search and Filter (placeholder for future functionality) -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 pb-4 border-b border-gray-700">
                        <h2 class="text-xl font-semibold text-gray-200 mb-3 sm:mb-0">All Admins</h2>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-400">{{ $admins->total() }} admins total</span>
                        </div>
                    </div>

                    <!-- Success Message -->
                    @if (session('success'))
                    <div class="bg-green-900 border-l-4 border-green-500 text-green-200 px-4 py-3 rounded-lg mb-6 shadow-sm">
                        {{ session('success') }}
                    </div>
                    @endif

                    <!-- Admin Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-700 rounded-lg overflow-hidden">
                            <thead class="bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3.5 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3.5 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Department
                                    </th>
                                    <th scope="col" class="px-6 py-3.5 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Position
                                    </th>
                                    <th scope="col" class="px-6 py-3.5 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Roles
                                    </th>
                                    <th scope="col" class="px-6 py-3.5 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-800 divide-y divide-gray-700">
                                @forelse ($admins as $admin)
                                <tr class="hover:bg-gray-750 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-100">{{ $admin->user->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-300">{{ $admin->department }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-300">{{ $admin->position }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @forelse ($admin->user->roles as $role)
                                        <span class="inline-block bg-blue-900 text-blue-200 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
                                            {{ $role->name }}
                                        </span>
                                        @empty
                                        <span class="text-gray-500 italic">No roles assigned</span>
                                        @endforelse
                                    </td>
                                    @if(!$admin->user->isSuperAdmin())
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-3">
                                            <a href="{{ route('admins.edit', $admin) }}" class="text-indigo-400 hover:text-indigo-300 transition-colors duration-150">
                                                <span class="sr-only">Edit</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('admins.destroy', $admin) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-300 transition-colors duration-150" onclick="return confirm('Are you sure you want to delete this admin?')">
                                                    <span class="sr-only">Delete</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    @else
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">This is SuperAdmin</td>
                                    @endif
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 whitespace-nowrap text-sm text-gray-400 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-500 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                            <p>No admins found.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $admins->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>