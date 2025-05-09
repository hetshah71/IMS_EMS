<x-dashboard-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 border-b border-gray-700">
                    <h2 class="text-2xl font-semibold text-gray-200 mb-6">Intern Details</h2>

                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-300">Name:</h3>
                        <p class="text-gray-200 text-base">{{ $intern->user->name }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-300">Email:</h3>
                        <p class="text-gray-200 text-base">{{ $intern->user->email }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-medium text-gray-300">Department:</h3>
                        <p class="text-gray-200 text-base">{{ $intern->department }}</p>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('interns.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors duration-200">
                            Back to Interns
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>