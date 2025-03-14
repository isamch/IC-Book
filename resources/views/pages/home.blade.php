@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <section class="home bg-cover bg-center bg-no-repeat flex justify-center items-center"
        style="background-image: url('/storage/images/books/default/banner-bg.jpg');">

        <div
            class="row flex flex-col md:flex-row items-center gap-32 py-10 px-16 max-w-7xl mx-auto space-y-16 md:space-y-0 md:space-x-32">

            <!-- Left Content (Text and Button) -->
            <div class="content flex-1 max-w-md order-2 md:order-1 text-center md:text-left">
                <h3 class="text-5xl font-semibold text-black mb-8">The best books ever</h3>
                <p class="text-xl text-gray-600 mb-8 leading-relaxed">Are you an avid reader or simply looking for literary
                    gems that will leave you spellbound? Look no further! Our website is your ultimate destination for the
                    best books ever written.</p>
                <a href="#featured"
                    class="btn bg-green-500 text-white py-4 px-10 rounded-lg text-2xl font-semibold hover:bg-green-600 transition">Download</a>
            </div>

            <!-- Right Content (Book Image and Stand) -->
            <div class="swiper books-slider flex-1 max-w-md text-center relative order-1 md:order-2">
                <a href="#featured" class="swiper-slide inline-block">
                    <img src="{{ asset('storage/images/books/default/book-1.png') }}" class="h-72 mx-auto shadow-xl"
                        alt="Book" style="object-fit: contain; margin-top: 2rem;">
                </a>
                <img src="{{ asset('storage/images/books/default/stand.png') }}" class="stand mt-[-2rem] mx-auto"
                    alt="Books Stand">
            </div>

        </div>

    </section>

    <section class="bg-gray-100 py-20 px-4">

        <div class="max-w-7xl mx-auto">
            <h2 class="text-4xl font-extrabold text-center text-gray-800 mb-16 relative">
                <a href="#books" class="relative z-10 cursor-pointer">Top 10 Books</a>
                <span
                    class="absolute left-1/2 transform -translate-x-1/2 -bottom-4 w-24 h-1.5 bg-green-500 rounded-full"></span>
                <span
                    class="absolute left-1/2 transform -translate-x-1/2 -bottom-6 w-16 h-1.5 bg-green-400 rounded-full opacity-50"></span>
            </h2>
            <div class="w-full h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent my-12"></div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @for ($i = 1; $i <= 8; $i++)
                    <div
                        class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-transform hover:scale-102 duration-200">
                        <div class="relative">
                            <img src="{{ asset('storage/images/books/default/book-1.png') }}" alt="Book {{ $i }}"
                                class="w-full h-72 object-cover object-center">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-0 hover:opacity-80 transition-opacity duration-300 flex items-end p-4">
                                <a href="#buy"
                                    class="inline-flex items-center bg-green-600 text-white py-2 px-6 rounded-full text-sm font-semibold hover:bg-green-800 transition-colors duration-100">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                <a href="#book{{ $i }}"
                                    class="text-gray-900 hover:text-green-500 cursor-pointer">Book Title
                                    {{ $i }}</a>
                            </h4>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::random(40) }}</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-1">
                                    @for ($j = 1; $j <= 5; $j++)
                                        @if ($j <= rand(3, 5))
                                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.953a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.366 2.445a1 1 0 00-.364 1.118l1.286 3.953c.3.921-.755 1.688-1.54 1.118l-3.366-2.445a1 1 0 00-1.176 0l-3.366 2.445c-.784.57-1.838-.197-1.54-1.118l1.286-3.953a1 1 0 00-.364-1.118L2.41 9.38c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.953z">
                                                </path>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.953a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.366 2.445a1 1 0 00-.364 1.118l1.286 3.953c.3.921-.755 1.688-1.54 1.118l-3.366-2.445a1 1 0 00-1.176 0l-3.366 2.445c-.784.57-1.838-.197-1.54-1.118l1.286-3.953a1 1 0 00-.364-1.118L2.41 9.38c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.953z">
                                                </path>
                                            </svg>
                                        @endif
                                    @endfor
                                    <span class="text-gray-500 text-xs ml-1">{{ rand(3, 5) }}.{{ rand(0, 9) }}</span>
                                </div>
                                <span class="text-gray-700 text-sm font-medium">${{ rand(10, 50) }}.99</span>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <!-- Show More Button -->
            <div class="text-center pt-8">
                <a href="/more-books"
                    class="inline-flex items-center bg-transparent text-gray-600 border border-gray-600 py-2 px-6 rounded-full text-sm font-medium hover:bg-gray-100 hover:text-gray-700 transition-colors duration-200">
                    Show More Books
                </a>
            </div>
        </div>
    </section>


    <section class="reviews bg-gray-100 py-2 px-4" id="reviews">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-4xl font-extrabold text-center text-gray-800 mb-16 relative">
                <a href="#books" class="relative z-10 cursor-pointer">Client's Reviews</a>
                <span
                    class="absolute left-1/2 transform -translate-x-1/2 -bottom-4 w-24 h-1.5 bg-green-500 rounded-full"></span>
                <span
                    class="absolute left-1/2 transform -translate-x-1/2 -bottom-6 w-16 h-1.5 bg-green-400 rounded-full opacity-50"></span>
            </h2>
            <div class="w-full h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent my-12"></div>

            <div class="swiper reviews-slider">
                <div
                    class="swiper-wrapper grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8 justify-center">
                    <!-- Review 1 -->
                    <div
                        class="swiper-slide box bg-white rounded-xl shadow-lg overflow-hidden transform transition-transform hover:scale-101 duration-300 hover:shadow-2xl mx-auto">
                        <div class="p-6 flex flex-col items-center">
                            <img src="http://icbooklibrary.kesug.com/img/review%20picture%20(4).jpeg" alt="Emma Johnson"
                                class="w-24 h-24 rounded-full object-cover mb-4">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Emma Johnson</h3>
                            <div class="stars flex items-center space-x-1 mb-4">
                                <i class="fas fa-star text-green-500"></i>
                                <i class="fas fa-star text-green-500"></i>
                                <i class="fas fa-star text-green-500"></i>
                                <i class="fas fa-star text-green-500"></i>
                                <i class="fas fa-star-half-alt text-green-500"></i>
                            </div>
                            <p class="text-gray-600 text-sm text-center line-clamp-3">This book download site is pure
                                genius. I'm an avid reader, and I've discovered a treasure trove of books I've always been
                                searching for. The user-friendly interface and comfortable design make reading an
                                unforgettable experience.</p>
                        </div>
                    </div>

                    <!-- Review 2 -->
                    <div
                        class="swiper-slide box bg-white rounded-xl shadow-lg overflow-hidden transform transition-transform hover:scale-101 duration-300 hover:shadow-2xl mx-auto">
                        <div class="p-6 flex flex-col items-center">
                            <img src="http://icbooklibrary.kesug.com/img/review%20picture%20(4).jpeg" alt="Amelia Martinez"
                                class="w-24 h-24 rounded-full object-cover mb-4">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Amelia Martinez</h3>
                            <div class="stars flex items-center space-x-1 mb-4">
                                <i class="fas fa-star text-green-500"></i>
                                <i class="fas fa-star text-green-500"></i>
                                <i class="fas fa-star text-green-500"></i>
                                <i class="fas fa-star text-green-500"></i>
                                <i class="fas fa-star-half-alt text-green-500"></i>
                            </div>
                            <p class="text-gray-600 text-sm text-center line-clamp-3">This little corner of the internet has
                                become my sanctuary. I can find books here that make my days better and more enriching.</p>
                        </div>
                    </div>

                    <!-- Review 3 -->
                    <div
                        class="swiper-slide box bg-white rounded-xl shadow-lg overflow-hidden transform transition-transform hover:scale-101 duration-300 hover:shadow-2xl mx-auto">
                        <div class="p-6 flex flex-col items-center">
                            <img src="http://icbooklibrary.kesug.com/img/review%20picture%20(4).jpeg" alt="Olivia Smith"
                                class="w-24 h-24 rounded-full object-cover mb-4">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Olivia Smith</h3>
                            <div class="stars flex items-center space-x-1 mb-4">
                                <i class="fas fa-star text-green-500"></i>
                                <i class="fas fa-star text-green-500"></i>
                                <i class="fas fa-star text-green-500"></i>
                                <i class="fas fa-star text-green-500"></i>
                                <i class="fas fa-star-half-alt text-green-500"></i>
                            </div>
                            <p class="text-gray-600 text-sm text-center line-clamp-3">I can't help but praise the quality
                                of service this site provides. Every time I search for a book, I find it here available for
                                download.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent my-12"></div>

    </section>



@endsection
