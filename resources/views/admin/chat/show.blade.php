<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto bg-gray-800 rounded-lg shadow-lg">
            <!-- Chat Header -->
            <div class="p-4 border-b border-gray-700 flex items-center">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center text-white font-bold">
                        {{ substr($receiver->name, 0, 1) }}
                    </div>
                    <h2 class="ml-3 text-xl font-semibold text-gray-200">{{ $receiver->name }}</h2>
                </div>
            </div>

            <!-- Messages Container -->
            <div id="messages" class="h-96 overflow-y-auto p-4 space-y-4">
                @foreach($messages as $message)
                <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <div class="{{ $message->sender_id === auth()->id() ? 'bg-blue-600 text-white' : 'bg-gray-700 text-gray-200' }} rounded-lg px-4 py-2 max-w-sm">
                        <p class="text-sm">{{ $message->content }}</p>
                        <span class="text-xs block mt-1 {{ $message->sender_id === auth()->id() ? 'text-blue-200' : 'text-gray-400' }}">
                            {{ $message->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Message Input -->
            <div class="p-4 border-t border-gray-700">
                <form id="messageForm" class="flex space-x-2" action="{{ route('chat.send', $receiver->id) }}" method="POST">
                    @csrf
                    <input id="messageInput" type="text" name="content" id="messageInput" class="flex-1 border border-gray-600 rounded-lg px-4 py-2 bg-gray-700 text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Type your message...">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Send</button>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Auto scroll + AJAX + Laravel Echo -->
    <script>
        $(document).ready(function() {
            const messagesDiv = $('#messages');
            messagesDiv.scrollTop(messagesDiv[0].scrollHeight);

            const form = $('#messageForm');
            const input = $('#messageInput');
            const token = $('input[name="_token"]').val(); // CSRF token

            form.on('submit', function(e) {
                e.preventDefault();

                const content = input.val().trim();
                if (!content) return;

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    contentType: 'application/json',
                    data: JSON.stringify({
                        content: content
                    }),
                    success: function(response) {
                        if (response.success) {
                            const msg = response.message;

                            const newMessage = `
                            <div class="flex justify-end">
                                <div class="bg-blue-600 text-white rounded-lg px-4 py-2 max-w-sm">
                                    <p class="text-sm">${msg.content}</p>
                                    <span class="text-xs block mt-1 text-blue-200">Just now</span>
                                </div>
                            </div>
                        `;
                            messagesDiv.append(newMessage);
                            input.val('');
                            messagesDiv.scrollTop(messagesDiv[0].scrollHeight);
                        } else {
                            alert('Message failed to send.');
                        }
                    },
                    error: function() {
                        alert('Message sending failed. Please try again.');
                    }
                });
            });

            const currentUserId = "{{ Auth::id() }}";
            const otherUserId = "{{ $receiver->id }}";
            const channelName = `chat.${otherUserId}.${currentUserId}`;

            console.log('Channel name:', channelName);

            // Laravel Echo listener
            window.Echo.channel(channelName)
                .listen('.MessageSent', function(e) { // Listen for messages sent to this channel
                    console.log('admin Message received:', e);

                    const messageHtml = `<div class="flex justify-start">
                        <div class="bg-gray-700 text-gray-200 rounded-lg px-4 py-2 max-w-sm">
                            <p class = "text-sm">${e.message.content}</p> 
                            <span class="text-xs block mt-1 text-gray-400">Just now</span> 
                        </div> 
                        </div>`;
                    messagesDiv.append(messageHtml);
                    messagesDiv.scrollTop(messagesDiv[0].scrollHeight);
                });
        });
    </script>


</x-app-layout>