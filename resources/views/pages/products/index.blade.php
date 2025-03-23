@extends('layouts.main')

@section('title', 'Books')

@section('content')
    <section class="bg-gray-100 py-10 px-4">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-4xl font-extrabold text-center text-gray-800 mb-16 relative">
                <a href="#products" class="relative z-10 cursor-pointer">Books</a>
                <span
                    class="absolute left-1/2 transform -translate-x-1/2 -bottom-4 w-24 h-1.5 bg-green-500 rounded-full"></span>
                <span
                    class="absolute left-1/2 transform -translate-x-1/2 -bottom-6 w-16 h-1.5 bg-green-400 rounded-full opacity-50"></span>
            </h2>
            <div class="w-full h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent my-12"></div>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar Filter -->
                <div class="w-full lg:w-1/4 bg-white rounded-xl shadow-lg p-6"
                    style="height: 800px; overflow-y: auto; scrollbar-width: thin; scrollbar-color: #48bb78 #f7fafc;">

                    <!-- Apply Filter Button -->
                    <button
                        class="w-full bg-green-600 text-white py-2 px-4 rounded-lg mb-6 hover:bg-green-700 transition-colors duration-200">
                        Apply Filter
                    </button>

                    <!-- Search Bar -->
                    <div class="mb-6">
                        <input type="text" placeholder="Search products..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>



                    <div class="space-y-6">
                        <!-- Category Filter -->
                        <div>
                            <h4 class="text-lg font-medium text-gray-800 mb-3">Categories</h4>
                            <ul class="space-y-2 max-h-48 overflow-y-auto"
                                style="scrollbar-width: thin; scrollbar-color: #48bb78 #f7fafc;">
                                @for ($i = 1; $i <= 15; $i++)
                                    <li>
                                        <label class="flex items-center space-x-2">
                                            <input type="checkbox"
                                                class="form-checkbox h-4 w-4 text-green-600 rounded focus:ring-green-500">
                                            <span class="text-gray-600">Category {{ $i }}</span>
                                        </label>
                                    </li>
                                @endfor
                            </ul>
                        </div>

                        <!-- Price Filter -->
                        <div>
                            <h4 class="text-lg font-medium text-gray-800 mb-3">Price Range</h4>
                            <ul class="space-y-2 max-h-48 overflow-y-auto"
                                style="scrollbar-width: thin; scrollbar-color: #48bb78 #f7fafc;">
                                <li>
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox"
                                            class="form-checkbox h-4 w-4 text-green-600 rounded focus:ring-green-500">
                                        <span class="text-gray-600">Under $50</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox"
                                            class="form-checkbox h-4 w-4 text-green-600 rounded focus:ring-green-500">
                                        <span class="text-gray-600">$50 - $100</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox"
                                            class="form-checkbox h-4 w-4 text-green-600 rounded focus:ring-green-500">
                                        <span class="text-gray-600">$100 - $200</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox"
                                            class="form-checkbox h-4 w-4 text-green-600 rounded focus:ring-green-500">
                                        <span class="text-gray-600">Over $200</span>
                                    </label>
                                </li>
                            </ul>
                        </div>

                        <!-- Rating Filter -->
                        <div>
                            <h4 class="text-lg font-medium text-gray-800 mb-3">Rating</h4>
                            <ul class="space-y-2">
                                <li>
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox"
                                            class="form-checkbox h-4 w-4 text-green-600 rounded focus:ring-green-500">
                                        <span class="text-gray-600">★★★★★</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox"
                                            class="form-checkbox h-4 w-4 text-green-600 rounded focus:ring-green-500">
                                        <span class="text-gray-600">★★★★☆ & Up</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox"
                                            class="form-checkbox h-4 w-4 text-green-600 rounded focus:ring-green-500">
                                        <span class="text-gray-600">★★★☆☆ & Up</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox"
                                            class="form-checkbox h-4 w-4 text-green-600 rounded focus:ring-green-500">
                                        <span class="text-gray-600">★★☆☆☆ & Up</span>
                                    </label>
                                </li>
                            </ul>
                        </div>

                        <!-- Availability Filter -->
                        <div>
                            <h4 class="text-lg font-medium text-gray-800 mb-3">Availability</h4>
                            <ul class="space-y-2">
                                <li>
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox"
                                            class="form-checkbox h-4 w-4 text-green-600 rounded focus:ring-green-500">
                                        <span class="text-gray-600">In Stock</span>
                                    </label>
                                </li>
                                <li>
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox"
                                            class="form-checkbox h-4 w-4 text-green-600 rounded focus:ring-green-500">
                                        <span class="text-gray-600">Out of Stock</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="w-full lg:w-3/4 bg-white rounded-xl shadow-lg p-6"
                    style="height: 800px; overflow-y: auto; scrollbar-width: thin; scrollbar-color: #48bb78 #f7fafc;">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                        @for ($i = 1; $i <= 12; $i++)
                            <div
                                class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-transform hover:scale-102 duration-200">
                                <div class="relative">
                                    <img src="{{ asset('storage/images/books/default/book-1.png') }}"
                                        alt="Product {{ $i }}" class="w-full h-60 object-cover object-center">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-0 hover:opacity-80 transition-opacity duration-300 flex items-end p-4">
                                        <a href="#buy"
                                            class="inline-flex items-center bg-green-600 text-white py-2 px-6 rounded-full text-sm font-semibold hover:bg-green-800 transition-colors duration-100">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                                </path>
                                            </svg>
                                            Buy Now
                                        </a>
                                    </div>
                                </div>

                                <div class="p-6">
                                    <h4 class="text-xl font-semibold text-gray-900 mb-2 truncate">
                                        <a href="#product{{ $i }}"
                                            class="text-gray-900 hover:text-green-500 cursor-pointer">Product Title
                                            {{ $i }}</a>
                                    </h4>

                                    <p class="text-gray-600 text-sm mb-4 line-clamp-3 overflow-hidden">
                                        {{ Str::limit("Lorem ipsum dolor sit amet consectetur adipisicing elit" . $i, 50, '...') }}
                                    </p>

                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-1">
                                            @for ($j = 1; $j <= 5; $j++)
                                                @if ($j <= rand(3, 5))
                                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.953a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.366 2.445a1 1 0 00-.364 1.118l1.286 3.953c.3.921-.755 1.688-1.54 1.118l-3.366-2.445a1 1 0 00-1.176 0l-3.366 2.445c-.784.57-1.838-.197-1.54-1.118l1.286-3.953a1 1 0 00-.364-1.118L2.41 9.38c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.953z">
                                                        </path>
                                                    </svg>
                                                @else
                                                    <svg class="w-4 h-4 text-gray-300" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.953a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.366 2.445a1 1 0 00-.364 1.118l1.286 3.953c.3.921-.755 1.688-1.54 1.118l-3.366-2.445a1 1 0 00-1.176 0l-3.366 2.445c-.784.57-1.838-.197-1.54-1.118l1.286-3.953a1 1 0 00-.364-1.118L2.41 9.38c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.953z">
                                                        </path>
                                                    </svg>
                                                @endif
                                            @endfor
                                            <span
                                                class="text-gray-500 text-xs ml-1">{{ rand(3, 5) }}.{{ rand(0, 9) }}</span>
                                        </div>
                                        <span class="text-gray-700 text-sm font-medium">${{ rand(10, 50) }}.99</span>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>

                    <!-- Show More Button -->
                    <div class="text-center pt-8">
                        <a href="/more-products"
                            class="inline-flex items-center bg-transparent text-gray-600 border border-gray-600 py-2 px-6 rounded-full text-sm font-medium hover:bg-gray-100 hover:text-gray-700 transition-colors duration-200">
                            Show More Products
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
