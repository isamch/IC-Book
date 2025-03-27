<!-- Header Section -->
<header class="bg-white shadow-md">
    <div class="container mx-auto flex justify-between items-center p-4">
        <!-- Logo -->
        <a href="/home" class="text-2xl font-bold text-gray-800">
            <i class="fas fa-book text-green-500"></i> IC Book
        </a>

        @auth
            <form class="flex items-center">
                <input type="search" placeholder="Search here..."
                    class="px-4 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-r-lg">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        @endauth

        <div class="flex items-center space-x-4">

            @auth
                <div class="flex items-center justify-center space-x-6">

                    <a href="#"
                        class="text-gray-800 relative flex items-center justify-center w-12 h-12 rounded-full bg-green-100 hover:bg-green-200">
                        <i class="fas fa-envelope text-xl text-green-500"></i>
                        {{-- @if (Auth::user()->unreadMessagesCount() > 0) --}}
                        <span class="absolute top-0 right-0 inline-block w-3 h-3 bg-red-500 rounded-full"></span>
                        {{-- @endif --}}
                    </a>

                    <a href="{{ route('seller.profile.show', Auth::user()->id) }}"
                        class="text-gray-800 flex items-center justify-center w-12 h-12 rounded-full bg-green-100 hover:bg-green-200">
                        @if (Auth::user()->photo)
                            <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile Image"
                                class="w-10 h-10 rounded-full border-2 border-green-500 object-cover">
                        @else
                            <i class="fas fa-user-circle text-2xl text-gray-500"></i>
                        @endif
                    </a>

                    <form method="POST" action="{{ route('logout') }}"
                        class="flex items-center justify-center w-12 h-12 rounded-full bg-red-100 hover:bg-red-200">
                        @csrf
                        <button type="submit"
                            class="flex items-center justify-center w-10 h-10 rounded-full text-gray-800 hover:text-red-500">
                            <i class="fas fa-sign-out-alt text-xl text-red-500"></i>
                        </button>
                    </form>

                </div>
            @else
                <a href="{{ route('login.form') }}"
                    class="px-4 py-1 border rounded-lg {{ request()->is('login') ? 'bg-green-500 text-white' : 'text-gray-800' }}">
                    Login
                </a>
                <a href="{{ route('register.form') }}"
                    class="px-4 py-1 border rounded-lg {{ request()->is('register') ? 'bg-green-500 text-white' : 'text-gray-800' }}">
                    Register
                </a>
            @endauth
        </div>
    </div>

    <nav class="bg-green-500 py-2">
        <div class="container mx-auto flex justify-center space-x-6">
            <a href="/home" class="text-white hover:text-gray-200">Home</a>
            <a href="/books" class="text-white hover:text-gray-200">Books</a>
            <a href="/posts" class="text-white hover:text-gray-200">posts</a>
            <a href="/marketplace" class="text-white hover:text-gray-200">Marketplace</a>
            <a href="/chat" class="text-white hover:text-gray-200">Chat</a>
        </div>
    </nav>
</header>
