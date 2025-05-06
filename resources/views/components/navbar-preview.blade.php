<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $ElectronicBook->title ?? 'PDF Viewer' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="h-full m-0 p-0 flex flex-col bg-gray-100 overflow-hidden">
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-2">
            <div class="flex justify-between items-center h-12">
                <a href="/home" class="text-lg font-bold text-gray-800 flex items-center">
                    <i class="fas fa-book text-green-500 mr-1"></i> IC Book
                </a>

                <div class="hidden md:flex items-center space-x-4">
                    <a href="/home" class="text-sm text-gray-700 hover:text-green-500">Home</a>
                    <a href="/books" class="text-sm text-gray-700 hover:text-green-500">Books</a>
                    <a href="/posts" class="text-sm text-gray-700 hover:text-green-500">Posts</a>
                    <a href="/marketplace/books" class="text-sm text-gray-700 hover:text-green-500">Marketplace</a>
                </div>

                <div class="flex items-center space-x-1">
                    @auth
                        <a href="
                            @if (auth()->user()->roles->contains('name', 'admin')) {{ route('admin.dashboard') }}
                            @elseif (auth()->user()->roles->contains('name', 'seller'))
                                {{ route('seller.dashboard') }}
                            @else
                                # @endif
                        "
                            class="text-gray-800 flex items-center justify-center w-8 h-8 rounded-full bg-green-100 hover:bg-green-200">
                            <i class="fas fa-cogs text-sm text-green-500"></i>
                        </a>

                        <a href="{{ route('buyer.profile.show', Auth::user()->id) }}"
                            class="text-gray-800 flex items-center justify-center w-8 h-8 rounded-full bg-green-100 hover:bg-green-200">
                            @if (Auth::user()->photo)
                                <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile"
                                    class="w-6 h-6 rounded-full border border-green-500 object-cover">
                            @else
                                <i class="fas fa-user-circle text-sm text-gray-500"></i>
                            @endif
                        </a>

                        <button id="mobile-menu-toggle"
                            class="md:hidden text-gray-800 flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200">
                            <i class="fas fa-bars text-sm"></i>
                        </button>
                    @else
                        <a href="{{ route('login.form') }}"
                            class="px-2 py-1 text-xs border rounded-lg {{ request()->is('login') ? 'bg-green-500 text-white' : 'text-gray-800' }}">
                            Login
                        </a>
                        <a href="{{ route('register.form') }}"
                            class="px-2 py-1 text-xs border rounded-lg {{ request()->is('register') ? 'bg-green-500 text-white' : 'text-gray-800' }}">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <div id="mobile-menu" class="md:hidden hidden bg-green-500 py-1">
        <div class="container mx-auto flex justify-around px-2">
            <a href="/home" class="text-xs text-white py-1">Home</a>
            <a href="/books" class="text-xs text-white py-1">Books</a>
            <a href="/posts" class="text-xs text-white py-1">Posts</a>
            <a href="/marketplace/books" class="text-xs text-white py-1">Marketplace</a>
            <a href="/chat" class="text-xs text-white py-1">Chat</a>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuToggle && mobileMenu) {
                mobileMenuToggle.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
