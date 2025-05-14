<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>{{ config('app.name', 'Task Management System') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-900">
        <nav class="bg-gray-800 border-b border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ auth()->guard('admin')->check() ? route('admin.dashboard') : route('intern.dashboard') }}"
                                class="text-xl font-bold text-gray-200">
                                Task Management System
                            </a>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="flex items-center ml-6">
                            <div class="ml-3 relative">
                                @if(Auth::user()->role=='intern' )
                                <a href="{{ route('intern.notifications.index') }}" class="text-gray-300 hover:text-white mr-4 relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                    @php
                                    $unreadCount =Auth::user()->intern->unreadNotifications->count();
                                    @endphp
                                    @if($unreadCount > 0)
                                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                        {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                                    </span>
                                    @endif
                                </a>
                                @endif
                                <span class="text-gray-200">{{ auth()->user()->name }}</span>
                                <form method="POST"
                                    action="{{ Auth::user()->role=='admin'  ? route('admin.logout') : route('intern.logout') }}"
                                    class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="ml-4 text-sm text-gray-300 hover:text-gray-100 bg-gray-700 px-3 py-1 rounded-md transition-colors">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>
    <script type="text/x-template" id="flash-messages">
        @if(session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        @endif

        @if(session('error'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        @endif
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const template = document.getElementById('flash-messages').textContent;
            const script = document.createElement('script');
            script.textContent = template;
            document.body.appendChild(script);
        });
    </script>
</body>

</html>