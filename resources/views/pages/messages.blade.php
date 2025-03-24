@extends('layouts.main')

@section('title', 'Chat')

@section('content')
    <div class="min-h-screen bg-gray-100 py-6 px-4">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Messages</h1>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl shadow-lg p-4 flex flex-col">

                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Conversations</h2>

                    <div class="overflow-y-auto space-y-3" style="max-height: calc(100vh - 250px); overflow-y: auto; scrollbar-width: thin; scrollbar-color: #48bb78 #f7fafc;">

                        @for ($i = 1; $i <= 5; $i++)
                            <div class="flex items-center gap-3 p-3 hover:bg-gray-200 rounded-lg cursor-pointer transition-colors duration-200 conversation-item {{ $i == 4 ? 'bg-yellow-100' : '' }}">

                                <img src="{{ asset('storage/images/profile/default/default-profile.png') }}" alt="User Image"
                                    class="w-10 h-10 rounded-full object-cover border-2 border-gray-200">

                                <div class="flex-1">
                                    <p class="text-base font-semibold text-gray-800">John Doe</p>
                                    <p class="text-xs text-gray-500">Hello, I'm interested in your book!</p>
                                </div>

                                <span class="w-3 h-3 rounded-full bg-green-500"></span> <!-- Green for online, change to bg-gray-500 for offline -->

                                <span class="text-xs text-gray-400">2h ago</span>
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- نافذة المحادثة -->
                <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-4 flex flex-col">
                    <div class="flex items-center justify-center h-full">
                        <p class="text-white bg-gradient-to-r from-green-400 to-blue-500 px-4 py-2 rounded-full">Select a chat to start messaging</p>
                    </div>

                    <div class="spinner hidden absolute inset-0 flex justify-center items-center">
                        <div class="w-16 h-16 border-4 border-t-4 border-green-500 rounded-full animate-spin"></div>
                    </div>

                    {{-- <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('storage/images/profile/default/default-profile.png') }}" alt="User Image"
                            class="w-10 h-10 rounded-full object-cover border-2 border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-700">Chat with John Doe</h2>
                    </div>
                    <hr class="border-t-2 border-gray-200 mb-4">

                    <!-- الرسائل -->
                    <div class="overflow-y-auto space-y-3" style="max-height: calc(100vh - 250px); overflow-y: auto; scrollbar-width: thin; scrollbar-color: #48bb78 #f7fafc;">

                        @for ($i = 1; $i <= 15; $i++)
                            <!-- رسالة من المستخدم -->
                            <div class="flex justify-end">
                                <div class="bg-green-100 rounded-lg p-3 max-w-[70%] shadow-sm">
                                    <p class="text-xs text-gray-800">Hello, I'm interested in your book!</p>
                                    <span class="text-[10px] text-gray-500 mt-1 block text-right">2h ago</span>
                                </div>
                            </div>

                            <!-- رسالة منك -->
                            <div class="flex justify-start">
                                <div class="bg-gray-100 rounded-lg p-3 max-w-[70%] shadow-sm">
                                    <p class="text-xs text-gray-800">Yes, it's still available. Would you like to meet?</p>
                                    <span class="text-[10px] text-gray-500 mt-1 block text-right">1h ago</span>
                                </div>
                            </div>
                        @endfor
                    </div>

                    <!-- مربع إرسال الرسالة -->
                    <div class="mt-4">
                        <textarea
                            class="w-full p-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition-all duration-200 resize-none"
                            rows="1" placeholder="Type your message..."></textarea>
                        <button
                            class="mt-2 w-full bg-green-600 text-white py-1.5 px-4 rounded-lg text-xs font-semibold hover:bg-green-700 transition-colors duration-200">
                            Send Message
                        </button>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const conversations = document.querySelectorAll(".conversation-item");

            conversations.forEach(conversation => {
                conversation.addEventListener("click", function () {

                    conversations.forEach(conv => conv.classList.remove("bg-gray-300"));

                    this.classList.add("bg-gray-300");
                });
            });

        });


    </script>
@endsection
