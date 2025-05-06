<x-guest-layout>
    <div class="mb-4 text-center">
        <h1 class="text-2xl font-bold text-gray-200">Admin Login</h1>
    </div>

    @if (session('error'))
        <div class="mb-4 text-sm text-red-400">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
            <div class="mt-1">
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="block w-full rounded-md border-gray-600 bg-gray-700 text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    autocomplete="email">
            </div>
            @error('email')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
            <div class="mt-1">
                <input id="password" type="password" name="password" required
                    class="block w-full rounded-md border-gray-600 bg-gray-700 text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    autocomplete="current-password">
            </div>
        </div>

        <div>
            <button type="submit"
                class="flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-800">
                Login
            </button>
        </div>

        <div class="text-sm text-center text-gray-400">
            Not registered?
            <a href="{{ route('admin.register.form') }}" class="font-medium text-indigo-400 hover:text-indigo-300">
                Register as Admin
            </a>
        </div>
    </form>
</x-guest-layout>