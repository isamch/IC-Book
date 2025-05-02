{{-- {{ dd( $elecBookOfTheMonth ) }} --}}

@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <section class="home bg-cover bg-center bg-no-repeat flex justify-center items-center"
        style="background-image: url('/storage/images/books/default/banner-bg.jpg');">

        <div
            class="row flex flex-col md:flex-row items-center gap-32 py-10 px-16 max-w-7xl mx-auto space-y-16 md:space-y-0 md:space-x-32">

            <div class="content flex-1 max-w-md order-2 md:order-1 text-center md:text-left">
                <h3 class="text-5xl font-semibold text-black mb-8">Book of the Month</h3>

                <h4 class="text-2xl font-semibold text-gray-800 mb-4">{{ $elecBookOfTheMonth->book->title }}</h4>
                <p class="text-xl text-gray-600 mb-8 leading-relaxed">{{ $elecBookOfTheMonth->book->description }}</p>

                <a href="{{ route('buyer.books.show', $elecBookOfTheMonth->id) }}"
                    class="btn bg-green-500 text-white py-3 px-8 rounded-lg text-base font-semibold hover:bg-green-600 transition-all duration-200">
                    Show Details
                </a>
            </div>

            <div class="swiper books-slider flex-1 max-w-md text-center relative order-1 md:order-2">
                <a href="#" class="swiper-slide inline-block">

                    <img src="{{ asset('storage/' . optional($elecBookOfTheMonth->book->images->first())->image) }}"
                        class="h-72 mx-auto rounded-lg shadow-2xl shadow-gray-800/80 shadow-black/60"
                        alt="Book of the Month"
                        style="object-fit: contain; margin-top: 2rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.75), 0 15px 30px -10px rgba(0, 0, 0, 0.5);">


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

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 justify-center items-center">

                @foreach ($topElecBooks as $topElecBook)
                    <div
                        class="bg-white rounded-md shadow-md overflow-hidden transform transition-transform hover:scale-101 duration-200">
                        <div class="relative">
                            <img src="{{ asset('storage/' . optional($topElecBook->book->images->first())->image) }}"
                                alt="{{ $topElecBook->book->title }}" class="w-full h-60 object-cover object-center">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-80 flex items-end p-3">
                                <a href="{{ route('buyer.books.show', $topElecBook->id) }}"
                                    class="inline-flex items-center bg-green-600 text-white py-1.5 px-4 rounded-full text-xs font-semibold hover:bg-green-800 transition-colors duration-100">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                    Buy Now
                                </a>
                            </div>
                        </div>

                        <div class="p-4">
                            <h4 class="text-lg font-semibold text-gray-900 mb-1 truncate">

                                <a href="{{ route('buyer.books.show', $topElecBook->id) }}"
                                    class="text-gray-900 hover:text-green-500 cursor-pointer">
                                    {{ $topElecBook->book->title }}
                                </a>
                            </h4>

                            <p class="text-gray-600 text-xs mb-3 line-clamp-2">
                                {{ Str::limit($topElecBook->book->description, 50, '...') }}
                            </p>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-1">


                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < $topElecBook->reviews->avg('rating'))
                                            <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        @else
                                            <i class="fas fa-star text-gray-300 text-xs"></i>
                                        @endif
                                    @endfor

                                    <span class="text-gray-500 text-xs ml-1">
                                        {{ number_format($topElecBook->reviews->avg('rating'), 1) }}
                                    </span>
                                </div>
                                <span class="text-gray-700 text-xs font-medium">
                                    ${{ number_format($topElecBook->book->price, 2) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="text-center pt-8">
                <a href="{{ route('buyer.books.index') }}"
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
