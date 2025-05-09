<x-dashboard-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 border-b border-gray-700">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold text-gray-200">Intern Management</h2>
                        <div class="space-x-2">

                            <a href="{{ route('interns.assign') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                Assign Task
                            </a>
                        </div>
                    </div>

                    @if (session('success'))
                    <div class="bg-green-900/30 border border-green-800 px-4 py-3 rounded relative mb-4">
                        <p class="text-sm text-green-300">{{ session('success') }}</p>
                    </div>
                    @endif

                    <div class="overflow-hidden shadow-sm sm:rounded-lg mt-6">
                        <div class="p-6 bg-gray-900 border-b border-gray-700">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-2xl font-semibold text-gray-200">Interns</h2>
                                <a href="{{ route('interns.create') }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors duration-200">
                                    Add New Intern
                                </a>
                            </div>

                            <div class="overflow-x-auto rounded-lg">
                                <table class="min-w-full divide-y divide-gray-700">
                                    <thead class="bg-gray-800">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                                Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                                Email
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                                Department
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-gray-900 divide-y divide-gray-800">
                                        @forelse ($interns as $intern)
                                        <tr class="hover:bg-gray-800 transition-colors duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">{{ $intern->user->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ $intern->user->email }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ $intern->department }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                                                <a href="{{ route('interns.show', $intern) }}" class="text-blue-400 hover:text-blue-300 hover:underline">View</a>
                                                <a href="{{ route('interns.edit', $intern) }}" class="text-indigo-400 hover:text-indigo-300 hover:underline">Edit</a>
                                                <form action="{{ route('interns.destroy', $intern) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-400 hover:text-red-300 hover:underline" onclick="return confirm('Are you sure?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-400">
                                                No interns found.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>