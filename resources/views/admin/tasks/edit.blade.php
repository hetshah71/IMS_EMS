<x-dashboard-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 border-b border-gray-700">
                    <h2 class="text-2xl font-semibold text-gray-200 mb-6">Edit Task</h2>

                    <form action="{{ route('tasks.update', $task) }}" method="POST" class="space-y-6" id="editTaskForm">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-300">Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}"
                                class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                required>
                            @error('title')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-300">Description</label>
                            <textarea name="description" id="description" rows="4"
                                class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                required>{{ old('description', $task->description) }}</textarea>
                            @error('description')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="due_date" class="block text-sm font-medium text-gray-300">Due Date</label>
                            <input type="date" name="due_date" id="due_date" value="{{ old('due_date', $task->due_date->format('Y-m-d')) }}"
                                class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                required>
                            @error('due_date')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-300">Status</label>
                            <select name="status" id="status"
                                class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                required>
                                <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            @error('status')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="interns" class="block text-sm font-medium text-gray-300">Assign Interns</label>
                            <select name="interns[]" id="interns" multiple
                                class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                required>
                                @foreach($interns as $intern)
                                <option value="{{ $intern->id }}"
                                    {{ in_array($intern->id, old('interns', $task->interns->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $intern->user->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('interns')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end space-x-3">
                            <a href="{{ route('tasks.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-300 bg-gray-700 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors duration-200">
                                Update Task
                            </button>
                        </div>
                    </form>

                    <!-- Comments Section -->
                    <div class="mt-10 pt-6 border-t border-gray-700">
                        <h3 class="text-xl font-semibold text-gray-200 mb-6">Comments</h3>

                        <!-- Display existing comments -->
                        <div class="space-y-4 mb-6">
                            @forelse($task->comments()->with('user')->latest()->get() as $comment)
                            <div class="bg-gray-700 p-4 rounded-lg">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-gray-300 font-medium">{{ $comment->user->name }}</p>
                                        <p class="text-gray-400 text-sm">{{ $comment->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <p class="text-gray-300 mt-2">{{ $comment->content }}</p>
                            </div>
                            @empty
                            <p class="text-gray-400">No comments yet.</p>
                            @endforelse
                        </div>

                        <!-- Add new comment -->
                        <form action="{{ route('tasks.comments.add', $task) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="content" class="block text-sm font-medium text-gray-300">Add a comment</label>
                                <textarea name="content" id="content" rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    required></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors duration-200">
                                    Add Comment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>