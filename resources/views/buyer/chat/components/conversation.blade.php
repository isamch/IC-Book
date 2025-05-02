@extends('layouts.main')

@section('title', 'Chat')

@section('content')
    <div class="min-h-screen bg-gray-50 py-6 sm:py-8 px-4 sm:px-6">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-6">Messages</h1>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex flex-col h-[calc(100vh-180px)] sm:h-[calc(100vh-200px)]">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Conversations</h2>
                        <div class="relative">
                            <input type="text" placeholder="Search..." class="w-full pl-8 pr-3 py-1.5 text-sm rounded-full border border-gray-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 absolute left-2.5 top-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <div class="overflow-y-auto flex-grow scrollbar-thin scrollbar-thumb-green-500 scrollbar-track-gray-100 pr-1">
                        <div class="space-y-1.5">
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="flex items-center gap-3 p-3 hover:bg-gray-50 rounded-lg cursor-pointer transition-all duration-200 conversation-item {{ $i == 4 ? 'bg-green-50 border-l-4 border-green-500' : '' }}">
                                    <div class="relative">
                                        <img src="{{ asset('storage/images/profile/default/default-profile.png') }}" alt="User Image"
                                            class="w-12 h-12 rounded-full object-cover border border-gray-200 shadow-sm">
                                        <span class="absolute bottom-0 right-0 w-3.5 h-3.5 rounded-full bg-green-500 border-2 border-white"></span>
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <div class="flex justify-between items-baseline">
                                            <p class="text-base font-semibold text-gray-800 truncate">John Doe {{ $i }}</p>
                                            <span class="text-xs text-gray-400 whitespace-nowrap">{{ $i }}h ago</span>
                                        </div>
                                        <p class="text-xs text-gray-500 truncate">Hello, I'm interested in your book! Would you be willing to negotiate the price?</p>
                                    </div>

                                    @if($i == 2 || $i == 4)
                                        <div class="flex-shrink-0 w-5 h-5 rounded-full bg-green-500 flex items-center justify-center">
                                            <span class="text-[10px] font-medium text-white">{{ $i }}</span>
                                        </div>
                                    @endif
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <!-- Chat Window -->
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex flex-col h-[calc(100vh-180px)] sm:h-[calc(100vh-200px)]">
                    <!-- Empty State -->
                    <div class="hidden flex-col items-center justify-center h-full space-y-4">
                        <div class="w-20 h-20 rounded-full bg-green-50 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </div>
                        <p class="text-gray-600 font-medium">Select a conversation to start messaging</p>
                        <button class="text-sm bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 shadow-sm">
                            Start New Chat
                        </button>
                    </div>

                    <div class="spinner hidden absolute inset-0 flex justify-center items-center bg-white bg-opacity-80 z-10">
                        <div class="w-12 h-12 border-4 border-gray-200 border-t-green-500 rounded-full animate-spin"></div>
                    </div>

                    <div class="flex flex-col h-full">
                        <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('storage/images/profile/default/default-profile.png') }}" alt="User Image"
                                    class="w-10 h-10 rounded-full object-cover border border-gray-200">
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-800">John Doe</h2>
                                    <p class="text-xs text-green-500">Online</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <button class="text-gray-400 hover:text-gray-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </button>
                                <button class="text-gray-400 hover:text-gray-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                    </svg>
                                </button>
                            </div>
                        </div>


                        <div class="flex-grow overflow-y-auto py-4 scrollbar-thin scrollbar-thumb-green-500 scrollbar-track-gray-100 px-1">
                            <div class="space-y-4">
                                <div class="flex justify-center">
                                    <span class="text-xs bg-gray-100 text-gray-500 px-3 py-1 rounded-full">Today</span>
                                </div>

                                @for ($i = 1; $i <= 8; $i++)
                                    @if($i % 2 == 1)
                                        <div class="flex items-end gap-2 max-w-[85%]">
                                            <img src="{{ asset('storage/images/profile/default/default-profile.png') }}" alt="User Image"
                                                class="w-8 h-8 rounded-full object-cover border border-gray-200 flex-shrink-0">
                                            <div>
                                                <div class="bg-gray-100 rounded-2xl rounded-bl-none p-3 shadow-sm">
                                                    <p class="text-sm text-gray-800">Hello, I'm interested in your book! Would you be willing to negotiate the price a bit?</p>
                                                </div>
                                                <span class="text-[10px] text-gray-400 ml-2">{{ $i }}:{{ $i * 10 }} PM</span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex justify-end">
                                            <div class="max-w-[85%]">
                                                <div class="bg-green-500 text-white rounded-2xl rounded-br-none p-3 shadow-sm">
                                                    <p class="text-sm">Yes, it's still available. I could consider a reasonable offer. What did you have in mind?</p>
                                                </div>
                                                <div class="flex items-center justify-end gap-1 mt-1">
                                                    <span class="text-[10px] text-gray-400">{{ $i }}:{{ $i * 10 }} PM</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endfor

                                <div class="flex items-end gap-2 max-w-[85%]">
                                    <img src="{{ asset('storage/images/profile/default/default-profile.png') }}" alt="User Image"
                                        class="w-8 h-8 rounded-full object-cover border border-gray-200 flex-shrink-0">
                                    <div class="bg-gray-100 rounded-2xl rounded-bl-none p-3 shadow-sm">
                                        <div class="flex space-x-1">
                                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 border-t border-gray-100 pt-4">
                            <div class="flex items-end gap-2">
                                <button class="text-gray-400 hover:text-gray-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                    </svg>
                                </button>
                                <div class="flex-grow relative">
                                    <textarea
                                        class="w-full p-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 resize-none text-sm"
                                        rows="1" placeholder="Type your message..."></textarea>
                                    <button class="absolute right-3 bottom-3 text-gray-400 hover:text-gray-600 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </div>
                                <button
                                    class="bg-green-500 hover:bg-green-600 text-white p-3 rounded-lg transition-colors duration-200 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const conversations = document.querySelectorAll(".conversation-item");
            const emptyState = document.querySelector(".flex-col.items-center.justify-center");
            const activeChat = document.querySelector(".flex.flex-col.h-full");

            emptyState.classList.add("hidden");
            activeChat.classList.remove("hidden");

            conversations.forEach(conversation => {
                conversation.addEventListener("click", function () {
                    conversations.forEach(conv => {
                        conv.classList.remove("bg-green-50", "border-l-4", "border-green-500");
                    });

                    this.classList.add("bg-green-50", "border-l-4", "border-green-500");

                    emptyState.classList.add("hidden");
                    activeChat.classList.remove("hidden");

                    const spinner = document.querySelector(".spinner");
                    spinner.classList.remove("hidden");
                    setTimeout(() => {
                        spinner.classList.add("hidden");
                    }, 500);
                });
            });
        });
    </script>
@endsection
