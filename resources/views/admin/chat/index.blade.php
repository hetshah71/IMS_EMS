<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 border-b border-gray-700">
                    <h2 class="text-2xl font-bold mb-4 text-gray-200">Chat with Interns</h2>
                    <div class="space-y-2">
                        @foreach ($users as $user)
                        <div class="p-3 border border-gray-700 rounded hover:bg-gray-700 transition-colors">
                            <a href="{{ route('chat.show', $user->id) }}" class="flex items-center">
                                <div>
                                    <h3 class="font-medium text-gray-200">{{ $user->name }}</h3>
                                    <p class="text-sm text-gray-400">{{ $user->email }}</p>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>