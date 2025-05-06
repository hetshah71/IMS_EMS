<x-guest-layout>
    <div class="mb-4 text-center">
        <h1 class="text-2xl font-bold text-gray-200">Admin Registration</h1>
    </div>

    @if (session('success'))
        <div class="mb-4 text-sm text-green-400">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.register') }}" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-300">Name</label>
            <div class="mt-1">
                <input id="name" type="text" name="name" value="{{ old('name') }}" required
                    class="block w-full rounded-md border-gray-600 bg-gray-700 text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            @error('name')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
            <div class="mt-1">
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="block w-full rounded-md border-gray-600 bg-gray-700 text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            @error('email')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <div class="mt-1">
                <input id="password" type="password" name="password" required
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <div class="mt-1">
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
        </div>

        <div>
            <label for="department" class="block text-sm font-medium text-gray-700">Department</label>
            <div class="mt-1">
                <input id="department" type="text" name="department" value="{{ old('department') }}" required
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            @error('department')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="position" class="block text-sm font-medium text-gray-300">Position</label>
            <div class="mt-1">
                <input id="position" type="text" name="position" value="{{ old('position') }}" required
                    class="block w-full rounded-md border-gray-600 bg-gray-700 text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            @error('position')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <button type="submit"
                class="flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-800">
                Register
            </button>
        </div>

        <div class="text-sm text-center text-gray-400">
            Already registered?
            <a href="{{ route('admin.login.form') }}" class="font-medium text-indigo-400 hover:text-indigo-300">
                Login
            </a>
        </div>
    </form>
</x-guest-layout>