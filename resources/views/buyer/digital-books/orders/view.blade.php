@extends('layouts.seller')

@section('title', 'Book Details')

@section('content')



    <div class="flex h-screen">
        <div class="w-64 bg-green-800 text-white p-4">
            <a href="{{ route('buyer.home') }}" class="flex items-center gap-3 mb-8">
                <i class="fas fa-book-open text-2xl"></i>
                <h1 class="text-xl font-bold">IC Book</h1>
            </a>

            <nav class="space-y-2">
                <a href="{{ route('buyer.books.orders.index') }}" class="flex items-center gap-3 p-3 rounded-lg bg-green-700">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Orders</span>
                </a>
                <a href="{{ route('buyer.profile.show', $user->id) }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
                <a href="{{ route('buyer.chat.index') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700">
                    <i class="fas fa-comments"></i>
                    <span>Chat</span>
                </a>
            </nav>
        </div>


        <div class="flex-1 overflow-y-auto p-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-green-800">Buyer Dashboard</h2>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <i class="fas fa-bell text-gray-600 text-xl"></i>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('buyer.profile.show', $user->id) }}" class="flex items-center gap-2">
                            <img src="{{ asset('storage/' . optional($user)->photo) }}" alt="Buyer"
                                class="w-8 h-8 rounded-full">
                            <span class="font-medium">
                                {{ $user->first_name }}
                                {{ $user->last_name }}
                            </span>
                        </a>
                    </div>
                </div>
            </div>





            <div class="rounded-xl p-6">



                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-green-800 px-6 py-4">
                        <h1 class="text-2xl font-semibold text-white" id="bookTitle">Book Details</h1>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                            <div class="col-span-1 flex justify-center">
                                <img id="bookCover"
                                    src="{{ asset('storage/' . optional($electronicBook->book->images->first())->image) }}"
                                    alt="Book cover" class="w-full max-w-xs h-auto object-cover rounded-lg shadow-md">
                            </div>

                            <div class="col-span-1 md:col-span-2 flex flex-col justify-between">
                                <div class="space-y-6">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Title</p>
                                            <p id="bookAuthor" class="mt-1 text-lg text-gray-900">
                                                {{ $electronicBook->book->title }}
                                            </p>
                                        </div>

                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Price</p>
                                            <p id="bookPrice" class="mt-1 text-lg font-semibold text-gray-900">
                                                $ {{ $electronicBook->book->price }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Author</p>
                                            <p id="bookAuthor" class="mt-1 text-lg text-gray-900">
                                                {{ $electronicBook->book->author }}
                                            </p>
                                        </div>

                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Rating</p>
                                            <div class="flex items-center mt-2">
                                                <div id="ratingStars" class="flex">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if ($i < $electronicBook->reviews->avg('rating'))
                                                            <i class="fas fa-star text-yellow-400"></i>
                                                        @else
                                                            <i class="fas fa-star text-gray-400"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Description</p>
                                        <p id="bookDescription" class="mt-2 text-gray-900">
                                            {{ $electronicBook->book->description }}
                                        </p>
                                    </div>

                                    <div class="border-t border-gray-200 pt-6">
                                        <p class="text-sm font-medium text-gray-500">Seller Information</p>
                                        <a href="{{ route('admin.users.show', $electronicBook->book->seller->user->id) }}"
                                            class="mt-4 flex items-center">
                                            <img id="sellerImage"
                                                src="{{ asset('storage/' . optional($electronicBook->book->seller->user)->photo) }}"
                                                alt="Seller" class="w-12 h-12 rounded-full border-2 border-green-200">
                                            <div class="ml-4">
                                                <p id="sellerName" class="text-lg font-medium text-gray-900">
                                                    {{ $electronicBook->book->seller->user->first_name }}
                                                    {{ $electronicBook->book->seller->user->last_name }}
                                                </p>
                                                <p id="sellerEmail" class="text-sm text-gray-500">
                                                    {{ $electronicBook->book->seller->user->email }}
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-between items-center">
                        <a href="{{ route('buyer.books.orders.index') }}"
                            class="px-6 py-2 border border-gray-300 rounded-lg text-base font-medium text-gray-700 hover:bg-gray-100 focus:outline-none flex items-center">
                            Back to List
                        </a>

                        <div class="flex space-x-4">
                            <a href="{{ route('buyer.books.preview.pdf', $electronicBook->id) }}"
                                class="px-6 py-2 border border-green-300 rounded-lg text-base font-medium text-green-600 hover:bg-green-100 focus:outline-none flex items-center">
                                <i class="fas fa-book-open mr-2 text-green-600"></i>
                                Read
                            </a>
                            <a href="{{ route('buyer.chat.conversation', $electronicBook->book->seller->user->id) }}"
                                class="px-6 py-2 border border-gray-300 rounded-lg text-base font-medium text-blue-600 hover:bg-blue-100 focus:outline-none flex items-center">
                                <i class="fas fa-envelope mr-2"></i>
                                Send Message
                            </a>


                        </div>
                    </div>

                </div>

            </div>



        </div>
    </div>


@endsection
