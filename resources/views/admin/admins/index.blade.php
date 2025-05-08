<x-dashboard-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Header Section -->
                    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-4 md:mb-0">Admin Management</h2>

                        <div class="flex flex-col md:flex-row md:items-center space-y-3 md:space-y-0 md:space-x-4">
                            <a href="{{ route('admins.create') }}"
                                class="inline-block bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-2.5 px-5 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
                                Create New Admin
                            </a>
                        </div>
                    </div>

                    <!-- Success Message -->
                    @if (session('success'))
                    <div
                        class="bg-green-50 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded-lg mb-6 shadow-sm">
                        {{ session('success') }}
                    </div>
                    @endif

                    <!-- Table Section -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                        Name</th>
                                    <th
                                        class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                        Department</th>
                                    <th
                                        class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                        Position</th>
                                    <th
                                        class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                        Roles</th>
                                    <th
                                        class="px-6 py-4 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($admins as $admin)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                        {{ $admin->user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                        {{ $admin->department }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                        {{ $admin->position }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                        @forelse ($admin->user->roles as $role)
                                        <span
                                            class="inline-block bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">
                                            {{ $role->name }}
                                        </span>
                                        @empty
                                        <span class="text-gray-500 italic">No roles assigned</span>
                                        @endforelse
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="{{ route('admins.edit', $admin) }}"
                                            class="text-indigo-600 hover:text-indigo-800 font-medium mr-4 transition duration-200">Edit</a>
                                        <form action="{{ route('admins.destroy', $admin) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Are you sure you want to delete this admin?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-800 font-medium transition duration-200">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                        No admins found.
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