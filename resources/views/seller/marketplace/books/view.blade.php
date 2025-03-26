@extends('layouts.seller')

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
                <a href="/seller/dashboard" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="/seller/marketplace" class="flex items-center gap-3 p-3 rounded-lg bg-green-700">
                    <i class="fas fa-book"></i>
                    <span>Physical Books</span>
                </a>
                <a href="/seller/books" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700">
                    <i class="fas fa-file-pdf"></i>
                    <span>Digital Books</span>
                </a>
                <a href="/seller/orders" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Orders</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto p-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-green-800">Seller Dashboard</h2>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <i class="fas fa-bell text-gray-600 text-xl"></i>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <img src="https://i.pravatar.cc/40" alt="Admin" class="w-8 h-8 rounded-full">
                        <span class="font-medium">Seller</span>
                    </div>
                </div>
            </div>


            {{-- other content here --}}


            <div class="rounded-xl p-6">



                <!-- Main content container -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <!-- Page header -->
                    <div class="bg-green-800 px-6 py-4">
                        <h1 class="text-2xl font-semibold text-white" id="bookTitle">Book Details</h1>
                    </div>

                    <!-- Page content -->
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <!-- Book cover -->
                            <div class="col-span-1 flex justify-center">
                                <img id="bookCover"
                                    src="{{ asset('storage/' . $physicalBook->book->images->first()->image) }}"
                                    alt="Book cover" class="w-full max-w-xs h-auto object-cover rounded-lg shadow-md">
                            </div>

                            <!-- Book details -->
                            <div class="col-span-1 md:col-span-2">
                                <div class="space-y-6">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Title</p>
                                        <p id="bookAuthor" class="mt-1 text-lg text-gray-900">
                                            {{ $physicalBook->book->title }}
                                        </p>
                                    </div>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Author</p>
                                            <p id="bookAuthor" class="mt-1 text-lg text-gray-900">
                                                {{ $physicalBook->book->author }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Price</p>
                                            <p id="bookPrice" class="mt-1 text-lg font-semibold text-gray-900">
                                                $ {{ $physicalBook->book->price }}
                                            </p>
                                        </div>
                                    </div>

                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Location</p>
                                        <p id="bookDescription" class="mt-2 text-gray-900">
                                            {{ $physicalBook->location }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Description</p>
                                        <p id="bookDescription" class="mt-2 text-gray-900">
                                            {{ $physicalBook->book->description }}
                                        </p>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Page footer (optional action buttons) -->
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end space-x-4">
                        <a href="/seller/marketplace"
                            class="px-6 py-2 border border-gray-300 rounded-lg text-base font-medium text-gray-700 hover:bg-gray-100 focus:outline-none">
                            Back to List
                        </a>
                        <a href="#" type="button" id="contactSellerBtn"
                            class="px-6 py-2 bg-green-600 rounded-lg text-base font-medium text-white hover:bg-green-700 focus:outline-none">
                            Edit Book
                        </a>
                    </div>
                </div>



            </div>




        </div>
    </div>


@endsection
