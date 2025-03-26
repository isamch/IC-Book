@extends('layouts.main')

@section('title', 'Book Details')

@section('content')
    <section class="bg-gray-100 py-10 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Book Details Section -->
            <div class="bg-white items-center rounded-xl shadow-lg p-8 flex flex-col lg:flex-row gap-8">
                <!-- Book Images -->
                <div class="flex-1">
                    <!-- Large Image -->
                    {{-- <div class="mb-6 ">
                        <img src="{{ asset('storage/images/books/default/book-1.png') }}" alt="Book Image" class="flex w-80 h-auto object-cover rounded-lg large-image">
                    </div> --}}

                    <div class="mb-6 flex justify-center">
                        <img src="{{ asset('storage/images/books/default/book-1.png') }}" alt="Book Image"
                            class="w-40 sm:w-48 md:w-56 lg:w-64 h-auto object-contain rounded-lg large-image">
                    </div>
                    <!-- Small Thumbnails -->
                    <div class="grid grid-cols-4 gap-4">
                        <img src="{{ asset('storage/images/books/default/book-1.png') }}" alt="Thumbnail 1"
                            class="w-full h-50 object-cover rounded-lg cursor-pointer hover:opacity-80 thumbnail">
                        <img src="{{ asset('storage/images/books/default/book-6.png') }}" alt="Thumbnail 2"
                            class="w-full h-50 object-cover rounded-lg cursor-pointer hover:opacity-80 thumbnail">
                        <img src="{{ asset('storage/images/books/default/book-6.png') }}" alt="Thumbnail 3"
                            class="w-full h-50 object-cover rounded-lg cursor-pointer hover:opacity-80 thumbnail">
                        <img src="{{ asset('storage/images/books/default/book-1.png') }}" alt="Thumbnail 4"
                            class="w-full h-50 object-cover rounded-lg cursor-pointer hover:opacity-80 thumbnail">
                    </div>
                </div>

                <div class="flex-1" style="height: fit-content">
                    <h1 class="text-3xl font-extrabold text-gray-800 mb-4">Book Title</h1>
                    <div class="flex items-center space-x-2 mb-6">
                        <div class="flex items-center">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= 4)
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.953a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.366 2.445a1 1 0 00-.364 1.118l1.286 3.953c.3.921-.755 1.688-1.54 1.118l-3.366-2.445a1 1 0 00-1.176 0l-3.366 2.445c-.784.57-1.838-.197-1.54-1.118l1.286-3.953a1 1 0 00-.364-1.118L2.41 9.38c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.953z">
                                        </path>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.953a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.366 2.445a1 1 0 00-.364 1.118l1.286 3.953c.3.921-.755 1.688-1.54 1.118l-3.366-2.445a1 1 0 00-1.176 0l-3.366 2.445c-.784.57-1.838-.197-1.54-1.118l1.286-3.953a1 1 0 00-.364-1.118L2.41 9.38c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.953z">
                                        </path>
                                    </svg>
                                @endif
                            @endfor
                        </div>
                        <span class="text-gray-500 text-sm">(4.5)</span>
                    </div>
                    <p class="text-gray-600 mb-6">
                        This is a detailed description of the book. It provides an overview of the content, the author's
                        perspective, and why it's a must-read. The description is engaging and informative, encouraging
                        potential readers to dive into the book.
                    </p>
                    <div class="flex items-center justify-between mb-8">
                        <span class="text-2xl font-bold text-gray-800">$29.99</span>
                        <button
                            class="bg-green-600 text-white py-2 px-6 rounded-full text-sm font-semibold hover:bg-green-700 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            Buy Now
                        </button>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="bg-white rounded-xl shadow-lg p-8 mt-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6" style="text-align: center">Reviews</h2>
                <div class="w-full h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent my-5"></div>

                <div class="mt-4">
                    <h3 class="text-base font-bold text-gray-700 mb-4">Add Your Rating</h3>
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                            <span class="text-gray-600 font-semibold">U</span>
                        </div>
                        <div class="flex-1 flex flex-col gap-4">
                            <div class="flex items-center space-x-2">
                                <span class="text-gray-600">Your Rating:</span>
                                <div class="flex space-x-1" id="starRating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <button type="button"
                                            class="text-gray-300 hover:text-yellow-400 focus:outline-none star"
                                            data-rating="{{ $i }}">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.364 1.118l1.518 4.674c.3.921-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.364-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.915a1 1 0 00.95-.69l1.519-4.674z">
                                                </path>
                                            </svg>
                                        </button>
                                    @endfor
                                </div>
                            </div>
                            <textarea id="comment" name="comment" rows="2"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 shadow-sm resize-none"
                                placeholder="Write your review..."></textarea>
                            <button type="submit"
                                class="whitespace-nowrap w-full md:w-auto bg-green-600 text-white py-2 px-6 rounded-full text-sm font-semibold hover:bg-green-700 transition-colors duration-200 shadow-md">
                                Submit Review
                            </button>
                        </div>
                    </div>
                </div>

                <div class="w-full h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent my-5"></div>

                <!-- Reviews List -->
                <div class="space-y-6 mt-4">
                    <h3 class="text-base font-bold text-gray-700 mb-4">Customer Reviews</h3>

                    <div class="max-h-96 overflow-y-auto scrollbar-thin scrollbar-thumb-green-500 scrollbar-track-gray-100"
                        style="overflow-y: auto; scrollbar-width: thin; scrollbar-color: #48bb78 #f7fafc;">
                        @for ($i = 1; $i <= 10; $i++)
                            <div class="border-b border-gray-200 pb-6">
                                <div class="flex items-start space-x-4">
                                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                                        <span class="text-gray-600 font-semibold">U{{ $i }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <h4 class="text-lg font-semibold text-gray-800">User {{ $i }}</h4>
                                            <span class="text-sm text-gray-500">2 days ago</span>
                                        </div>

                                        <div class="flex items-center space-x-1 mt-2">
                                            @php
                                                $rating = rand(3, 5);
                                            @endphp
                                            @for ($j = 1; $j <= 5; $j++)
                                                @if ($j <= $rating)
                                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.953a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.366 2.445a1 1 0 00-.364 1.118l1.286 3.953c.3.921-.755 1.688-1.54 1.118l-3.366-2.445a1 1 0 00-1.176 0l-3.366 2.445c-.784.57-1.838-.197-1.54-1.118l1.286-3.953a1 1 0 00-.364-1.118L2.41 9.38c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.953z">
                                                        </path>
                                                    </svg>
                                                @else
                                                    <svg class="w-5 h-5 text-gray-300" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.953a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.366 2.445a1 1 0 00-.364 1.118l1.286 3.953c.3.921-.755 1.688-1.54 1.118l-3.366-2.445a1 1 0 00-1.176 0l-3.366 2.445c-.784.57-1.838-.197-1.54-1.118l1.286-3.953a1 1 0 00-.364-1.118L2.41 9.38c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.953z">
                                                        </path>
                                                    </svg>
                                                @endif
                                            @endfor
                                            <span class="text-sm text-gray-500">({{ $rating }}.0)</span>
                                        </div>
                                        <style>
                                            details[open] summary {
                                                display: none;
                                            }
                                        </style>
                                        <details class="mt-2">
                                            <summary class="list-none cursor-pointer text-gray-600 hover:text-green-600">
                                                {{ Str::words('This is a review from User ' . $i . '. They found the book very informative and engaging. Highly recommended!', 10, '...') }}
                                            </summary>
                                            <p class="text-gray-600 mt-2">
                                                This is a review from User {{ $i }}. They found the book very
                                                informative and
                                                engaging. Highly recommended! recommended!
                                            </p>
                                        </details>
                                    </div>
                                </div>
                            </div>
                        @endfor

                        <!-- Show More Button -->
                        <div class="text-center mt-4">
                            <button
                                class="bg-green-600 text-white py-2 px-6 rounded-full text-sm font-semibold hover:bg-green-700 transition-colors duration-200">
                                Show More
                            </button>
                        </div>
                    </div>
                </div>



            </div>


        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const largeImage = document.querySelector('.large-image');
            const thumbnails = document.querySelectorAll('.thumbnail');

            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener('click', function() {
                    largeImage.src = this.src;
                });
            });
        });
    </script>


    {{-- js to get rating number  --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star');
            const starRatingContainer = document.getElementById('starRating');

            let selectedRating = 0;

            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const rating = parseInt(this.getAttribute(
                        'data-rating'));

                    selectedRating = rating;

                    stars.forEach((s, index) => {
                        if (index < rating) {
                            s.querySelector('svg').classList.add(
                                'text-yellow-400');
                            s.querySelector('svg').classList.remove('text-gray-300');
                        } else {
                            s.querySelector('svg').classList.remove(
                                'text-yellow-400');
                            s.querySelector('svg').classList.add('text-gray-300');
                        }
                    });

                    console.log('Selected Rating:', selectedRating);
                });
            });


        });
    </script>
@endsection
