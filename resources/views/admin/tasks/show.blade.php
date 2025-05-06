<x-dashboard-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 border-b border-gray-700">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold text-gray-200">Task Details</h2>
                        <div class="space-x-2">
                            <a href="{{ route('tasks.edit', $task) }}" 
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500">
                                Edit
                            </a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this task?')"
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-red-500">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="bg-gray-700 p-6 rounded-lg mb-6">
                        <h3 class="text-xl font-semibold text-gray-200 mb-2">{{ $task->title }}</h3>
                        <p class="text-gray-300 mb-4">{{ $task->description }}</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <p class="text-gray-400">Status: 
                                    <span class="
                                        @if($task->status == 'completed') text-green-400
                                        @elseif($task->status == 'in_progress') text-yellow-400
                                        @else text-red-400
                                        @endif
                                    ">
                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                    </span>
                                </p>
                                <p class="text-gray-400">Due Date: {{ $task->due_date->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-400">Created By: {{ $task->creator->name }}</p>
                                <p class="text-gray-400">Created At: {{ $task->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        
                        <div>
                            <h4 class="text-lg font-medium text-gray-300 mb-2">Assigned Interns:</h4>
                            <ul class="list-disc list-inside text-gray-400">
                                @forelse($task->interns as $intern)
                                    <li>{{ $intern->user->name }}</li>
                                @empty
                                    <li>No interns assigned</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Comments Section -->
                    <div class="mt-6">
                        <h3 class="text-xl font-semibold text-gray-200 mb-4">Comments</h3>
                        
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
                        <form action="{{ route('tasks.comments.add', $task) }}" method="POST">
                            @csrf
                            <div>
                                <label for="content" class="block text-sm font-medium text-gray-300">Add a comment</label>
                                <textarea name="content" id="content" rows="3" 
                                    class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    required></textarea>
                            </div>
                            <div class="mt-3">
                                <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500">
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
