{{-- {{  dd(Auth::user());  }} --}}

<!-- Responsive Header Section -->
<header class="bg-white shadow-md">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Top Bar -->
        <div class="flex flex-col sm:flex-row justify-between items-center py-3">
            <!-- Logo -->
            <a href="/home" class="text-xl sm:text-2xl font-bold text-gray-800 mb-3 sm:mb-0">
                <i class="fas fa-book text-green-500"></i> IC Book
            </a>

            @auth
                <div class="hidden sm:block w-full max-w-md mx-4">
                    <form class="flex items-center">
                        <input type="search" placeholder="Search user..."
                            class="w-full px-3 py-1.5 text-sm border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        <button type="submit" class="px-3 py-1.5 bg-green-500 text-white rounded-r-lg">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            @endauth

            <div class="flex items-center space-x-2 sm:space-x-4">
                @auth
                    <button id="mobile-search-toggle"
                        class="sm:hidden text-gray-800 flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-200">
                        <i class="fas fa-search text-lg"></i>
                    </button>



                    <a href="{{ route('buyer.books.orders.index') }}"
                        class="text-gray-800 relative flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-green-100 hover:bg-green-200">
                        <i class="fas fa-book text-lg sm:text-xl text-green-500"></i>
                    </a>
                    @if (auth()->user()->roles->contains('name', 'admin'))
                        <a href="{{ route('admin.dashboard') }}"
                            class="text-gray-800 relative flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-green-100 hover:bg-green-200">
                            <i class="fas fa-cogs text-lg sm:text-xl text-green-500"></i>
                        </a>
                    @elseif (auth()->user()->roles->contains('name', 'seller'))
                        <a href="{{ route('seller.dashboard') }}"
                            class="text-gray-800 relative flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-green-100 hover:bg-green-200">
                            <i class="fas fa-cogs text-lg sm:text-xl text-green-500"></i>
                        </a>
                    @endif



                    <a href="{{ route('buyer.profile.show', Auth::user()->id) }}"
                        class="text-gray-800 flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-green-100 hover:bg-green-200">
                        @if (Auth::user()->photo)
                            <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="Profile Image"
                                class="w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-green-500 object-cover">
                        @else
                            <i class="fas fa-user-circle text-xl sm:text-2xl text-gray-500"></i>
                        @endif
                    </a>

                    <form method="POST" action="{{ route('logout') }}"
                        class="flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-red-100 hover:bg-red-200">
                        @csrf
                        <button type="submit"
                            class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 rounded-full text-gray-800 hover:text-red-500">
                            <i class="fas fa-sign-out-alt text-lg sm:text-xl text-red-500"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login.form') }}"
                        class="px-3 py-1 text-sm sm:px-4 sm:py-1.5 border rounded-lg {{ request()->is('login') ? 'bg-green-500 text-white' : 'text-gray-800' }}">
                        Login
                    </a>
                    <a href="{{ route('register.form') }}"
                        class="px-3 py-1 text-sm sm:px-4 sm:py-1.5 border rounded-lg {{ request()->is('register') ? 'bg-green-500 text-white' : 'text-gray-800' }}">
                        Register
                    </a>
                @endauth

                <button id="mobile-menu-toggle"
                    class="md:hidden text-gray-800 flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-200">
                    <i class="fas fa-bars text-lg"></i>
                </button>

            </div>

        </div>

        @auth
            <div id="mobile-search" class="sm:hidden pb-3 hidden">
                <form class="flex items-center">
                    <input type="search" placeholder="Search user..."
                        class="w-full px-3 py-1.5 text-sm border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    <button type="submit" class="px-3 py-1.5 bg-green-500 text-white rounded-r-lg">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        @endauth
    </div>

    <nav class="bg-green-500 relative">
        <button id="mobile-menu-toggle" class="md:hidden absolute left-4 top-1/2 transform -translate-y-1/2 text-green-700">
            <i class="fas fa-bars text-lg"></i>
        </button>

        <div class="container mx-auto hidden md:flex justify-center space-x-6 py-2">
            <a href="/home" class="text-white hover:text-gray-200">Home</a>
            <a href="/books" class="text-white hover:text-gray-200">Books</a>
            <a href="/posts" class="text-white hover:text-gray-200">Posts</a>
            <a href="/marketplace/books" class="text-white hover:text-gray-200">Marketplace</a>
            <a href="{{ route('buyer.chat.index') }}" class="text-white hover:text-gray-200">Chat</a>
        </div>

        <div id="mobile-menu" class="md:hidden hidden bg-green-600 py-2">
            <div class="container mx-auto flex flex-col space-y-2 px-4">
                <a href="/home" class="text-white hover:text-gray-200 py-1 border-b border-green-500">Home</a>
                <a href="/books" class="text-white hover:text-gray-200 py-1 border-b border-green-500">Books</a>
                <a href="/posts" class="text-white hover:text-gray-200 py-1 border-b border-green-500">Posts</a>
                <a href="/marketplace/books"
                    class="text-white hover:text-gray-200 py-1 border-b border-green-500">Marketplace</a>
                <a href="{{ route('buyer.chat.index') }}" class="text-white hover:text-gray-200 py-1">Chat</a>
            </div>
        </div>
    </nav>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuToggle && mobileMenu) {
            mobileMenuToggle.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }

        const mobileSearchToggle = document.getElementById('mobile-search-toggle');
        const mobileSearch = document.getElementById('mobile-search');

        if (mobileSearchToggle && mobileSearch) {
            mobileSearchToggle.addEventListener('click', function() {
                mobileSearch.classList.toggle('hidden');
            });
        }
    });
</script>
