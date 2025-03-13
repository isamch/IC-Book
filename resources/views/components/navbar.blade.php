<!-- Header Section -->
<header class="bg-white shadow-md">
    <div class="container mx-auto flex justify-between items-center p-4">
        <!-- Logo -->
        <a href="/home" class="text-2xl font-bold text-gray-800">
            <i class="fas fa-book text-green-500"></i> IC Book
        </a>

        @auth
            <!-- Search Bar -->
            <form class="flex items-center">
                <input type="search" placeholder="Search here..."
                    class="px-4 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-r-lg">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        @endauth

        <!-- Right Section: Authentication & Icons -->
        <div class="flex items-center space-x-4">

            @auth
                <div id="search-btn" class="text-gray-800 cursor-pointer">
                    <i class="fas fa-search"></i>
                </div>

                <a href="#featured" class="text-gray-800">
                    <i class="fas fa-heart"></i>
                </a>

                <div class="relative">
                    <button class="text-gray-800 flex items-center">
                        <i class="fas fa-user"></i>
                        <span class="ml-2">{{ auth()->user()->name }}</span>
                    </button>
                    <!-- Dropdown Menu -->
                    <div class="absolute right-0 mt-2 bg-white shadow-md rounded-md w-48 hidden group-hover:block">
                        <a href="{{ route('profile') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profile</a>

                        @if (auth()->user()->role == 'admin')
                            <a href="{{ route('admin.dashboard') }}"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Admin Dashboard</a>
                        @elseif(auth()->user()->role == 'seller')
                            <a href="{{ route('seller.dashboard') }}"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Seller Dashboard</a>
                        @elseif(auth()->user()->role == 'buyer')
                            <a href="{{ route('buyer.dashboard') }}"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Buyer Dashboard</a>
                        @endif

                        <form action="{{ route('logout') }}" method="POST" class="block">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <!-- Show only on Login & Register Pages -->
                @if (!request()->routeIs('login') && !request()->routeIs('register'))
                    <a href="/login" class="text-gray-800">Login</a>
                    <a href="{{ route('register.form') }}" class="text-gray-800">Register</a>
                @endif
            @endauth
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="bg-green-500 py-2">
        <div class="container mx-auto flex justify-center space-x-6">
            <a href="/home" class="text-white hover:text-gray-200">Home</a>
            <a href="#featured" class="text-white hover:text-gray-200">Featured</a>
            <a href="#arrivals" class="text-white hover:text-gray-200">Arrivals</a>
            <a href="#reviews" class="text-white hover:text-gray-200">Reviews</a>
            <a href="#blogs" class="text-white hover:text-gray-200">Blogs</a>
        </div>
    </nav>
</header>
