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

                        @for ($i = 1; $i <= 20; $i++)
                            <div
                                class="flex items-center gap-3 p-3 hover:bg-gray-50 rounded-lg cursor-pointer transition-all duration-200 conversation-item
                                {{ $i == 1 ? 'bg-green-50 border-l-4 border-green-500' : '' }}">

                                <div class="relative">
                                    <img src="{{ asset('storage/images/profile/default/default-profile.png') }}"
                                        alt="User Image"
                                        class="w-12 h-12 rounded-full object-cover border border-gray-200 shadow-sm">
                                    <span
                                        class="absolute bottom-0 right-0 w-3.5 h-3.5 rounded-full bg-green-500 border-2 border-white"></span>
                                </div>

                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-baseline">
                                        <p class="text-base font-semibold text-gray-800 truncate">John Doe
                                            {{ $i }}</p>
                                        <span class="text-xs text-gray-400 whitespace-nowrap">{{ $i }}h
                                            ago</span>
                                    </div>
                                    <p class="text-xs text-gray-500 truncate">Hello, I'm interested in your book! Would
                                        you be willing to negotiate the price?</p>
                                </div>

                                @if ($i == 2 || $i == 4)
                                    <div
                                        class="flex-shrink-0 w-5 h-5 rounded-full bg-green-500 flex items-center justify-center">
                                        <span class="text-[10px] font-medium text-white">{{ $i }}</span>
                                    </div>
                                @endif
                            </div>
                        @endfor
                    </div>
                </div>

                <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-4 flex flex-col">
                    <div class="flex items-center justify-center h-full">
                        <p class="text-white bg-gradient-to-r from-green-400 to-blue-500 px-4 py-2 rounded-full">Select a
                            chat to start messaging</p>
                    </div>

                    <div class="spinner hidden absolute inset-0 flex justify-center items-center">
                        <div class="w-16 h-16 border-4 border-t-4 border-green-500 rounded-full animate-spin"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
