{{-- {{ dd( $electronicBooks[1]->reviews->count()  ) }} --}}
{{-- {{ dd( $electronicBooks[0]->reviews->avg('rating') ) }} --}}



@extends('layouts.admin')

@section('title', 'Book')

@section('content')



    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-green-800 text-white p-4">
            <div class="flex items-center gap-3 mb-8">
                <i class="fas fa-book-open text-2xl"></i>
                <h1 class="text-xl font-bold">IC Book</h1>
            </div>

            <nav class="space-y-2">
                <a href="/admin/dashboard" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="/admin/users" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
                <a href="/admin/marketplace" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700">
                    <i class="fas fa-book"></i>
                    <span>Physical Books</span>
                </a>
                <a href="/admin/book" class="flex items-center gap-3 p-3 rounded-lg bg-green-700">
                    <i class="fas fa-file-pdf"></i>
                    <span>Digital Books</span>
                </a>
                <a href="/admin/orders" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Orders</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto p-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-green-800">Admin Dashboard</h2>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <i class="fas fa-bell text-gray-600 text-xl"></i>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <img src="https://i.pravatar.cc/40" alt="Admin" class="w-8 h-8 rounded-full">
                        <span class="font-medium">Admin</span>
                    </div>
                </div>
            </div>


            {{-- content here --}}
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-gray-500">Total Users</p>
                            <p class="text-2xl font-bold">1,248</p>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                            <i class="fas fa-users text-green-600"></i>
                        </div>
                    </div>
                    <p class="text-sm text-green-600 mt-2"><i class="fas fa-arrow-up"></i> 12% from last month</p>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-gray-500">Physical Books</p>
                            <p class="text-2xl font-bold">856</p>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-book text-blue-600"></i>
                        </div>
                    </div>
                    <p class="text-sm text-blue-600 mt-2"><i class="fas fa-arrow-up"></i> 5% from last month</p>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-gray-500">Digital Books</p>
                            <p class="text-2xl font-bold">1,532</p>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center">
                            <i class="fas fa-file-pdf text-purple-600"></i>
                        </div>
                    </div>
                    <p class="text-sm text-purple-600 mt-2"><i class="fas fa-arrow-up"></i> 24% from last month</p>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-gray-500">Total Orders</p>
                            <p class="text-2xl font-bold">324</p>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center">
                            <i class="fas fa-shopping-cart text-yellow-600"></i>
                        </div>
                    </div>
                    <p class="text-sm text-yellow-600 mt-2"><i class="fas fa-arrow-up"></i> 8% from last month</p>
                </div>
            </div>

            {{-- other content here --}}


            <!-- Users Management -->
            <div class="bg-white rounded-xl shadow-lg p-6">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-green-800">Books Management</h3>
                    {{-- <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Add New User</button> --}}
                </div>




                <div class="overflow-x-auto bg-white rounded-lg shadow">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Book ID</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Title</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Author</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Price</th>

                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Seller</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                            {{-- 'title',
                            'author',
                            'description',
                            'price',
                            'seller_id', --}}

                            @foreach ($electronicBooks as $electronicBook)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $electronicBook->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ Str::words($electronicBook->book->title, 3, '...') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $electronicBook->book->author }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$
                                        {{ $electronicBook->book->price }}</td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">

                                            <div class="flex-shrink-0 h-10 w-10">

                                                <img class="h-10 w-10 rounded-full"
                                                    src="{{ asset('storage/' . $electronicBook->book->seller->user->photo) }}"
                                                    alt="Seller">
                                            </div>

                                            {{-- "id" => 3
                                            "first_name" => "Shayne"
                                            "last_name" => "Feil"
                                            "email" => "ezra.maggio@example.com"
                                            "email_verified_at" => null
                                            "password" => "$2y$10$pSS1Pc88/AfgShrXoLyfzOQiQhpNaWkaPStn4gPdELIMC2PNCTM9C"
                                            "age" => 61
                                            "remember_token" => null
                                            "created_at" => "2025-03-24 17:24:58"
                                            "updated_at" => "2025-03-24 17:24:58"
                                            "birthdate" => "1964-03-24"
                                            "photo" => "images/profile/default/default-profile.png"
                                            "verification_token" => null
                                            "status" => true --}}

                                            <div class="ml-4">
                                                <a href="#"
                                                    class="text-sm font-medium text-gray-900 hover:underline">
                                                    {{ $electronicBook->book->seller->user->first_name }}
                                                    {{ $electronicBook->book->seller->user->last_name }}

                                                </a>
                                                <div class="text-xs text-gray-500">
                                                    {{ $electronicBook->book->seller->user->email }}
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-4">

                                            <button onclick="showBookDetails({{ $electronicBook->id }})"
                                                class="text-green-600 hover:text-indigo-900">
                                                <i class="fas fa-eye mr-1"></i>
                                            </button>

                                            <button class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash mr-1"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                {{-- pagination --}}
                <div class="mt-4">
                    {{ $electronicBooks->links() }}
                </div>


            </div>






        </div>
    </div>

    {{-- fetch error --}}
    <div id="error-alert"
        class="hidden fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-lg shadow-xl transition-opacity duration-500 ease-in-out z-50 max-w-sm w-full flex items-center space-x-4">
        <div class="flex-grow">
            <span class="font-semibold">Error:</span>
            <ul id="errorMessage">

            </ul>
        </div>
        <button class="text-red-700 focus:outline-none" onclick="closeAlert('error-alert')">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    @include('admin.books.digital.components.view-modal')


    <script>

        // detch view for each book:
        function showBookDetails(bookId) {
            fetch(`/admin/books/${bookId}`)
                .then(response => response.json())
                .then(electronicBook => {


                    document.getElementById('bookCover').src = `/storage/${electronicBook.cover}`;

                    document.getElementById('bookTitle').textContent = electronicBook.title;
                    document.getElementById('bookAuthor').textContent = electronicBook.author;
                    document.getElementById('bookPrice').textContent = `$${electronicBook.price}`;
                    document.getElementById('bookDescription').textContent = electronicBook.description;


                    for (let i = 0; i < 5; i++) {
                        if (i < electronicBook.rating) {
                            document.getElementById('ratingStars').innerHTML += '<i class="fas fa-star text-yellow-400"></i>';

                        } else {
                            document.getElementById('ratingStars').innerHTML += '<i class="fas fa-star text-gray-400"></i>';
                        }
                    }

                    document.getElementById('sellerName').textContent = electronicBook.seller.first_name + ' ' +
                        electronicBook.seller.last_name;

                    document.getElementById('sellerEmail').textContent = electronicBook.seller.email;

                    document.getElementById('sellerImage').src = `/storage/${electronicBook.seller.image}`;

                    document.getElementById('bookModal').classList.remove('hidden');

                })
                .catch(error => {
                    document.getElementById('errorMessage').textContent = "something wrong";
                    document.getElementById('error-alert').classList.remove('hidden');

                });
        }


        function closeModal() {
            document.getElementById('bookModal').classList.add('hidden');
        }



    </script>


@endsection
