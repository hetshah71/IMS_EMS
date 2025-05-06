<x-dashboard-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Intern Details</h2>

                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-700">Name:</h3>
                        <p class="text-gray-900 text-base">{{ $intern->user->name }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-700">Email:</h3>
                        <p class="text-gray-900 text-base">{{ $intern->user->email }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-700">Department:</h3>
                        <p class="text-gray-900 text-base">{{ $intern->department }}</p>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('interns.index') }}"
                            class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Back to Interns
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>