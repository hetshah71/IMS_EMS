<x-guest-layout>
    <div class="mb-4 text-center">
        <h1 class="text-2xl font-bold text-gray-200">Admin Login</h1>
        <p class="mt-1 text-sm text-gray-400">Access your admin dashboard</p>
    </div>
    <form method="POST" action="{{ route('admin.login') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                class="w-full px-3 py-2 rounded-md border border-gray-700 bg-gray-700 text-gray-200 placeholder-gray-500
                       focus:border-indigo-500 focus:ring-indigo-500 focus:ring-1"
                placeholder="admin@example.com"
                autocomplete="email">
            @error('email')
            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
            <input id="password" type="password" name="password" required
                class="w-full px-3 py-2 rounded-md border border-gray-700 bg-gray-700 text-gray-200 placeholder-gray-500
                       focus:border-indigo-500 focus:ring-indigo-500 focus:ring-1"
                placeholder="••••••••"
                autocomplete="current-password">
        </div>

        <button type="submit"
            class="w-full px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md 
                   transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            Sign In
        </button>
    </form>
</x-guest-layout>