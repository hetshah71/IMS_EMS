<x-app-layout>
    <div class="flex min-h-screen bg-gray-900">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white flex-shrink-0">
            <a href="{{ route('admin.dashboard') }}" class="block p-6 text-2xl font-bold border-b border-gray-700 hover:bg-gray-700 transition duration-150">
                Admin Panel
            </a>
            <nav class="mt-4">
                @can('manage-tasks')
                <a href="{{ route('tasks.index') }}" class="block px-6 py-3 hover:bg-gray-700 transition duration-150">
                    Tasks
                </a>
                @endcan
                @can('manage-interns')
                <a href="{{ route('interns.index') }}" class="block px-6 py-3 hover:bg-gray-700 transition duration-150">
                    Interns
                </a>
                @endcan
                @can('manage-admins')
                <a href="{{ route('admins.index') }}" class="block px-6 py-3 hover:bg-gray-700 transition duration-150">
                    Admins
                </a>
                @endcan
                @can('manage-roles')
                <a href="{{ route('roles.index') }}" class="block px-6 py-3 hover:bg-gray-700 transition duration-150">
                    Roles
                </a>
                @endcan
                @can('manage-permissions')
                <a href="{{ route('permissions.index') }}" class="block px-6 py-3 hover:bg-gray-700 transition duration-150">
                    Permissions
                </a>
                @endcan
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="bg-gray-800 shadow rounded-lg p-6 text-gray-200">
                {{ $slot }}
            </div>
        </main>
    </div>
</x-app-layout>