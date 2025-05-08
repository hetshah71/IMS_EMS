<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">Chat with Admins</h2>
                    <div class="space-y-2">
                        @foreach ($users as $user)
                        <div class="p-3 border rounded hover:bg-gray-50">
                            <a href="{{ route('intern.chat.show', $user->id) }}" class="flex items-center">
                                <div>
                                    <h3 class="font-medium">{{ $user->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
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