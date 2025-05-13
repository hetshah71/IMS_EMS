<x-dashboard-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 border-b border-gray-700">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold text-gray-200">Role Management</h2>
                        <div class="space-x-2">
                            <a href="{{ route('roles.create') }}"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors duration-200">
                                <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Create New Role
                            </a>
                        </div>
                    </div>


                    <div class="overflow-hidden shadow-sm sm:rounded-lg mt-6">
                        <div class="p-6 bg-gray-900 border-b border-gray-700">
                            <div class="overflow-x-auto rounded-lg">
                                <table class="min-w-full divide-y divide-gray-700">
                                    <thead class="bg-gray-800">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                                Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                                Permissions
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-gray-900 divide-y divide-gray-800">
                                        @forelse ($roles as $role)
                                        <tr class="hover:bg-gray-800 transition-colors duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-200">{{ $role->name }}</div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-400">
                                                    @if($role->permissions->isEmpty())
                                                    <span class="text-gray-500 italic">No permissions assigned</span>
                                                    @else
                                                    <div class="flex flex-wrap gap-2">
                                                        @foreach($role->permissions as $permission)
                                                        <span class="inline-block bg-blue-900 text-blue-200 text-xs font-medium px-2.5 py-0.5 rounded">
                                                            {{ $permission->name }}
                                                        </span>
                                                        @endforeach
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                                                <a href="{{ route('roles.edit', $role) }}" class="text-indigo-400 hover:text-indigo-300 hover:underline">Edit</a>
                                                <form action="{{ route('roles.destroy', $role) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="text-red-400 hover:text-red-300 transition-colors duration-150"
                                                        data-delete-url="{{ route('roles.destroy', $role) }}"
                                                        onclick="openDeleteModal('{{ $role->id }}', '{{ $role->name }}', this)">
                                                        <span class="sr-only">Delete</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="px-6 py-8 text-center">
                                                <div class="flex flex-col items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-500 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                                    </svg>
                                                    <p class="text-sm text-gray-400">No roles found.</p>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="deleteModal" class="fixed inset-0 bg-gray-900/75 hidden items-center justify-center z-50">
        <div class="bg-gray-800 rounded-lg p-6 max-w-md w-full mx-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold text-white">Confirm Delete</h3>
                <button onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-300">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <p class="text-gray-300 mb-6">Are you sure you want to delete this Role "<span id="roleName" class="font-medium"></span>"? This action cannot be undone.</p>
            <div class="flex justify-end space-x-3">
                <button onclick="closeDeleteModal()" class="px-4 py-2 text-sm font-medium text-gray-300 hover:text-white bg-gray-700 rounded-lg hover:bg-gray-600 transition-colors duration-150">
                    Cancel
                </button>
                <form id="deleteForm" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors duration-150">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function openDeleteModal(roleId, roleName, button) {
            const $modal = $('#deleteModal');
            const $deleteForm = $('#deleteForm');
            const $titleSpan = $('#roleName');

            $deleteForm.attr('action', $(button).data('delete-url'));
            $titleSpan.text(roleName);
            $modal.removeClass('hidden').addClass('flex');
        }

        function closeDeleteModal() {
            const $modal = $('#deleteModal');
            $modal.addClass('hidden').removeClass('flex');
        }
    </script>
</x-dashboard-layout>