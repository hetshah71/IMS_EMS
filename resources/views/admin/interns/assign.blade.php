<x-dashboard-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 border-b border-gray-700">
                    <h2 class="text-2xl font-semibold text-gray-200 mb-6">Assign Task to Intern</h2>

                    <form id="assignTaskForm" action="{{ route('interns.assign.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Intern Selection -->
                        <div>
                            <label for="intern_id" class="block text-sm font-medium text-gray-300">Select Intern</label>
                            <select name="intern_id" id="intern_id" required
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-600 bg-gray-700 text-gray-200 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">Select an intern</option>
                                @foreach($interns as $intern)
                                <option value="{{ $intern->id }}">{{ $intern->user->name }} - {{ $intern->department }}
                                </option>
                                @endforeach
                            </select>
                            @error('intern_id')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Task Selection -->
                        <div>
                            <label for="task_id" class="block text-sm font-medium text-gray-300">Select Tasks</label>
                            <select name="task_id[]" id="task_id" multiple required
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-600 bg-gray-700 text-gray-200 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                @foreach($tasks as $task)
                                <option value="{{ $task->id }}">
                                    {{ $task->title }} (Due: {{ $task->due_date->format('Y-m-d') }})
                                </option>
                                @endforeach
                            </select>

                            @error('task_id')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end space-x-3">
                            <a href="{{ route('interns.index') }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-300 bg-gray-700 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500">
                                Cancel
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500">
                                Assign Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>