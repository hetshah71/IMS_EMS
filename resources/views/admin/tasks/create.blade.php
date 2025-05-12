<x-dashboard-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-1">Create New Task</h1>
                    <p class="text-gray-400">Add a new task for your interns</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('tasks.index') }}"
                        class="bg-gray-700 hover:bg-gray-600 text-white font-medium py-2.5 px-5 rounded-lg inline-flex items-center transition-all duration-200 shadow-lg">
                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Tasks
                    </a>
                </div>
            </div>

            <div class="bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg border border-gray-700">
                <div class="p-6">

                    <form action="{{ route('tasks.store') }}" method="POST" class="space-y-6" id='createTaskForm'>
                        @csrf

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-300">Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}"
                                class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-300">Description</label>
                            <textarea name="description" id="description" rows="4"
                                class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description') }}</textarea>
                            @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="due_date" class="block text-sm font-medium text-gray-300">Due Date</label>
                            <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}"
                                class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('due_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-300">Status</label>
                            <select name="status" id="status"
                                class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="interns" class="block text-sm font-medium text-gray-300">Assign Interns</label>
                            <select name="interns[]" id="interns" multiple
                                class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                @foreach($interns as $intern)
                                <option value="{{ $intern->id }}" {{ in_array($intern->id, old('interns', [])) ? 'selected' : '' }}>
                                    {{ $intern->user->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('interns')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end space-x-3">
                            <a href="{{ route('tasks.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-300 bg-gray-700 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500">
                                Create Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>