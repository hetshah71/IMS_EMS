<x-app-layout>
    <div class="flex min-h-screen bg-gray-900">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white flex-shrink-0">
            <x-nav-link href="{{ route('admin.dashboard') }}" class="block p-6 text-2xl font-bold border-b" :active="request()->routeIs('admin.dashboard')">
                Admin Panel
            </x-nav-link>
            <nav class="mt-4">
                @can('manage-tasks')
                <x-nav-link href="{{ route('tasks.index') }}" :active="request()->routeIs('tasks*')">
                    Tasks
                </x-nav-link>
                @endcan
                @can('manage-interns')
                <x-nav-link href="{{ route('interns.index') }}" :active="request()->routeIs('interns*')">
                    Interns
                </x-nav-link>
                @endcan
                @can('manage-admins')
                <x-nav-link href="{{ route('admins.index') }}" :active="request()->routeIs('admins*')">
                    Admins
                </x-nav-link>
                @endcan
                @can('manage-roles')
                <x-nav-link href="{{ route('roles.index') }}" :active="request()->routeIs('roles*')">
                    Roles
                </x-nav-link>
                @endcan
                @can('manage-permissions')
                <x-nav-link href="{{ route('permissions.index') }}" :active="request()->routeIs('permissions*')">
                    Permissions
                </x-nav-link>
                @endcan
                <x-nav-link href="{{ route('chat.index') }}" :active="request()->routeIs('chat.index')">
                    Chat
                </x-nav-link>
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