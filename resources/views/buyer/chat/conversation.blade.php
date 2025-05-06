@extends('layouts.main')

@section('title', 'Chat')

@section('content')
    <div class="min-h-screen bg-gray-100 py-6 px-4">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Messages</h1>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl shadow-lg p-4 flex flex-col">

                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Conversations</h2>

                    <div class="overflow-y-auto space-y-3"
                        style="max-height: calc(100vh - 250px); overflow-y: auto; scrollbar-width: thin; scrollbar-color: #48bb78 #f7fafc;">

                        @foreach ($contacts as $contact)
                            <a href="{{ route('buyer.chat.conversation', $contact->id) }}"
                                class="flex items-center gap-3 p-3 hover:bg-gray-50 rounded-lg cursor-pointer transition-all duration-200 conversation-item
                                {{-- {{ $contact->last_message->sender_id === $contact->id ? 'bg-green-50 border-l-4 border-green-500' : '' }} --}}
                                {{ $contact->id === $contactChat->id ? 'bg-gray-300 border-l-4 border-green-500' : '' }} ">

                                <div class="relative">
                                    <img src="{{ asset('storage/' . optional($contact)->photo) }}" alt="User Image"
                                        class="w-12 h-12 rounded-full object-cover border border-gray-200 shadow-sm">

                                    {{-- online offline --}}
                                    <span
                                        class="absolute bottom-0 right-0 w-3.5 h-3.5 rounded-full bg-green-500 border-2 border-white">
                                    </span>
                                </div>

                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-baseline">
                                        <p class="text-base font-semibold text-gray-800 truncate">
                                            {{ $contact->first_name }}
                                            {{ $contact->last_name }}
                                        </p>
                                        <span class="text-xs text-gray-400 whitespace-nowrap">
                                            {{ $contact->last_message->updated_at->diffForHumans() }}
                                        </span>
                                    </div>

                                    <p data-sender-uncheck-contact-id="{{ $contact->id }}"
                                        class="text-xs text-gray-500 truncate">
                                        @if ($contact->last_message->sender_id != $contact->id)
                                            @if ($contact->last_message->is_read)
                                                <i class="fas fa-check-double text-green-500 text-xs"></i>
                                            @else
                                                <i class="fas fa-check text-gray-400 text-xs"
                                                    data-sender-uncheck-id="{{ $contact->last_message->sender_id }}"></i>
                                            @endif
                                        @endif

                                        {{ $contact->last_message->content }}
                                    </p>

                                </div>

                                {{-- @if ($contact->unread_count && $contact->id != $contactChat->id)
                                    <div
                                        class="flex-shrink-0 w-4 h-4 rounded-full bg-green-500 flex items-center justify-center">
                                        <span class="text-[9px] font-semibold text-white leading-none">
                                            {{ $contact->unread_count }}
                                        </span>
                                    </div>
                                @endif --}}

                                <div data-sender-notification-contact-id="{{ $contact->id }}"
                                    class="flex-shrink-0 w-4 h-4 rounded-full bg-green-500
                                    flex items-center justify-center

                                    @if ($contact->unread_count == 0 || $contact->id == $contactChat->id)

                                        hidden

                                    @endif">

                                    <span class="text-[9px] font-semibold text-white leading-none">
                                        {{ $contact->unread_count }}
                                    </span>

                                </div>

                            </a>
                        @endforeach

                    </div>
                </div>

                <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-4 flex flex-col">

                    <div class="flex flex-col h-full justify-between">
                        <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('storage/' . optional($contactChat)->photo) }}" alt="User Image"
                                    class="w-10 h-10 rounded-full object-cover border border-gray-200">
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-800">
                                        {{ $contactChat->first_name }}
                                        {{ $contactChat->last_name }}
                                    </h2>
                                    <p class="text-xs text-green-500">
                                        Online
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <button class="text-gray-400 hover:text-gray-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </button>
                                <button class="text-gray-400 hover:text-gray-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                    </svg>
                                </button>
                            </div>
                        </div>


                        <div id="scroll-conversation" class="overflow-y-auto space-y-3"
                            style="max-height: calc(100vh - 250px); overflow-y: auto; scrollbar-width: thin; scrollbar-color: #48bb78 #f7fafc;">

                            @php
                                $lastDate = null;
                            @endphp


                            <div id="messagesContainer"  data-messages-container="{{ $contactChat->id }}"
                                class="space-y-4">

                                @foreach ($messages as $message)
                                    @if ($message->formatted_date !== $lastDate)
                                        <div class="flex justify-center">
                                            <span class="text-xs bg-gray-100 text-gray-500 px-3 py-1 rounded-full">
                                                {{ $message->formatted_date }}

                                            </span>
                                        </div>
                                        @php $lastDate = $message->formatted_date; @endphp
                                    @endif





                                    @if ($message->sender_id != Auth::user()->id)
                                        <div class="flex items-end" style="width: 70%;">

                                            <div class="flex gap-2 items-center">
                                                <img src="{{ asset('storage/' . optional($contactChat)->photo) }}"
                                                    alt="User Image"
                                                    class="w-8 h-8 rounded-full object-cover border border-gray-200 flex-shrink-0">
                                                <div>
                                                    <div class="bg-gray-100 rounded-2xl rounded-bl-none p-3 shadow-sm">
                                                        <p class="text-sm text-gray-800">
                                                            {{ $message->content }}
                                                        </p>
                                                    </div>
                                                    <span style="font-size: 10px; color: #6b7280; margin-left: 0.5rem;">
                                                        {{ $message->full_datetime }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex justify-end">

                                            <div class="max-w-[85%]">
                                                <div
                                                    class="bg-green-500 text-white rounded-2xl rounded-br-none p-3 shadow-sm">
                                                    <p class="text-sm">
                                                        {{ $message->content }}
                                                    </p>
                                                </div>
                                                <div class="flex items-center justify-end gap-1 mt-1">
                                                    <span style="font-size: 10px; color: #6b7280; margin-left: 0.5rem;">
                                                        {{ $message->full_datetime }}
                                                    </span>

                                                    @if ($message->is_read)
                                                        <i class="fas fa-check-double text-green-500 text-xs"></i>
                                                    @else
                                                        <i class="fas fa-check text-gray-400 text-xs"
                                                            data-sender-uncheck-id="{{ $message->sender_id }}"></i>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    @endif
                                @endforeach


                            </div>
                        </div>




                        <div class="mt-4 border-t border-gray-100 pt-4">
                            <div class="flex items-center gap-2">
                                <div class="flex-grow relative">
                                    <input type="text" id="messageInput"
                                        class="w-full p-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 text-sm"
                                        placeholder="Type your message..." />
                                </div>

                                <button id="sendMessageButton"
                                    class="bg-green-500 hover:bg-green-600 text-white p-3 rounded-lg transition-colors duration-200 flex items-center justify-center">
                                    <i class="fas fa-paper-plane text-sm"></i>
                                </button>

                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>




    {{-- script --}}
    <script>
        document.getElementById('sendMessageButton').addEventListener('click', function() {
            let message = document.getElementById('messageInput').value;

            if (message.trim() !== "") {
                fetch('{{ route('buyer.chat.message.send') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            message: message,
                            receiver_id: {{ $contactChat->id }}
                        })
                    })
                    .then(response => response.json())
                    .then(data => {

                        if (data.success) {

                            appendSenderMessage(data.message.content, data.full_datetime, data.message.sender_id);
                            appendMessageContact(data.message, true);
                            document.getElementById('messageInput').value = '';
                            scrollDown();

                        }

                    })
                    .catch(error => console.error('the Error:', error));
            }
        });


        // send message convesation append
        function appendMessageContact(message, mine) {

            let otherUserId = message.sender_id;

            let uncheckMessageContact = document.querySelector(`[data-sender-uncheck-contact-id="${otherUserId}"]`);
            if (!uncheckMessageContact) {
                uncheckMessageContact = document.querySelector(`[data-sender-uncheck-contact-id="${message.receiver_id}"]`);
            }


            if (uncheckMessageContact) {

                if (mine) {

                    uncheckMessageContact.innerHTML = `
                        <i class="fas fa-check text-gray-400 text-xs"
                        data-sender-uncheck-id="${otherUserId}"></i>

                        ${ message.content }
                    `;

                } else {

                    uncheckMessageContact.innerHTML = `${ message.content }`;

                }
            }


        };



        // display message :
        function appendSenderMessage(content, fullDateTime, sender_id) {
            let user_id = document.querySelector('meta[name="user-id"]').getAttribute('content');

            const messageWrapper = document.createElement('div');
            messageWrapper.classList.add('flex', 'justify-end');

            messageWrapper.setAttribute('data-sender-id', user_id);

            messageWrapper.innerHTML = `
                <div class="max-w-[85%]">
                    <div
                        class="bg-green-500 text-white rounded-2xl rounded-br-none p-3 shadow-sm">
                        <p class="text-sm">
                            ${content}
                        </p>
                    </div>
                    <div class="flex items-center justify-end gap-1 mt-1">
                        <span style="font-size: 10px; color: #6b7280; margin-left: 0.5rem;">
                            ${fullDateTime}
                        </span>

                        <i class="fas fa-check text-gray-400 text-xs" data-sender-uncheck-converation-id="${ user_id }"></i>
                    </div>
                </div>
            `;

            const messagesContainer = document.getElementById('messagesContainer');
            if (messagesContainer) {
                messagesContainer.appendChild(messageWrapper);
            }
        }
    </script>

    {{-- script foe laravel echo --}}
    <script>
        window.addEventListener('DOMContentLoaded', function() {

            let user_id = document.querySelector('meta[name="user-id"]').getAttribute('content');

            window.Echo.private('chat.' + user_id)
                .listen('MessageSent', (e) => {


                    appendReceiveMessage(e.message);
                    appendMessageContact(e.message, false);
                    showNotification(e.message.sender_id, e.message.count_unread);
                    seenMessage();

                });

        });


        // show notifcation:
        function showNotification(otherUserId, unreadCount) {

            let currentContactId = {{ $contactChat->id }};

            const contactNotificationCount = document.querySelector(
                `[data-sender-notification-contact-id="${otherUserId}"]`);


            if (otherUserId == currentContactId) {
                return;
            }

            contactNotificationCount.classList.remove('hidden');
            contactNotificationCount.querySelector('span').textContent = unreadCount;
        };



        // append recive message :
        function appendReceiveMessage(message) {



            const messageElement = document.createElement('div');
            messageElement.className = 'flex items-end w-[70%]';

            messageElement.innerHTML = `
                <div class="flex gap-2 items-center">
                    <img src="{{ asset('storage/' . optional($contactChat)->photo) }}"
                        alt="User Image"
                        class="w-8 h-8 rounded-full object-cover border border-gray-200 flex-shrink-0">
                    <div>
                        <div class="bg-gray-100 rounded-2xl rounded-bl-none p-3 shadow-sm">
                            <p class="text-sm text-gray-800">
                                ${message.content}
                            </p>
                        </div>
                        <span style="font-size: 10px; color: #6b7280; margin-left: 0.5rem;">
                            ${message.full_datetime}
                        </span>
                    </div>
                </div>
            `;


            const messagesContainer = document.querySelector(`[data-messages-container="${message.sender_id}"]`);


            if (messagesContainer) {
                messagesContainer.appendChild(messageElement);
            }

            scrollDown();
        }


        function scrollDown() {
            const scrollChat = document.getElementById('scroll-conversation');
            scrollChat.scrollTop = scrollChat.scrollHeight;

        }
        scrollDown();
    </script>


    <script>
        // make message seen

        window.addEventListener('DOMContentLoaded', function() {

            let user_id = document.querySelector('meta[name="user-id"]').getAttribute('content');


            Echo.private('seen.' + user_id)
                .listen('MarkAsReadEvent', (event) => {
                    markMessagesAsRead(event.user_seen_id, event.user_send_meg);
                });


        });



        function markMessagesAsRead(contactId, myid) {

            const uncheckMessageConversation = document.querySelectorAll(`[data-sender-uncheck-converation-id="${myid}"]`);


            let uncheckMessageContact = document.querySelectorAll(`[data-sender-uncheck-contact-id="${contactId}"]`);
            if (!uncheckMessageContact) {
                uncheckMessageContact = document.querySelectorAll(`[data-sender-uncheck-contact-id="${message.myid}"]`);
            }



            uncheckMessageConversation.forEach(msg => {
                if (msg) {
                    msg.classList.remove('text-gray-400', 'fa-check');
                    msg.classList.add('text-green-500', 'fa-check-double');
                }
            });


            uncheckMessageContact.forEach(msg => {
                if (msg) {
                    const icon = msg.querySelector('i');
                    if (icon) {
                        icon.classList.remove('text-gray-400', 'fa-check');
                        icon.classList.add('text-green-500', 'fa-check-double');
                    }
                }
            });

        }

    </script>


    <script>
        function seenMessage() {



            let user_id = document.querySelector('meta[name="user-id"]').getAttribute('content');

            let otherUserId = {{ $contactChat->id }};
            let isInCurrentPage = window.location.pathname === '/chat/' + otherUserId;


            if (isInCurrentPage) {


                fetch('/chat/mark-as-read', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            sender_id: otherUserId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {

                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });

            }


        }

        // seenMessage();
    </script>
@endsection
