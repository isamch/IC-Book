@foreach ($electronicBooks as $electronicBook)
    <div
        class="bg-white rounded-md shadow-md overflow-hidden transform transition-all duration-300 hover:shadow-lg hover:-translate-y-1">


        <div class="relative">
            <img src="{{ asset('storage/' . optional($electronicBook->book->images->first())->image) }}"
                alt="{{ $electronicBook->book->title }}" class="w-full h-60 object-cover object-center">
            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-80 flex items-end p-3">
                <a href="{{ route('buyer.books.show', $electronicBook->id) }}"
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

                <a href="{{ route('buyer.books.show', $electronicBook->id) }}" class="text-gray-900 hover:text-green-500 cursor-pointer">
                    {{ $electronicBook->book->title }}
                </a>
            </h4>

            <p class="text-gray-600 text-xs mb-3 line-clamp-2">
                {{ Str::limit($electronicBook->book->description, 50, '...') }}
            </p>

            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-1">


                    @for ($i = 0; $i < 5; $i++)
                        @if ($i < $electronicBook->reviews->avg('rating'))
                            <i class="fas fa-star text-yellow-400 text-xs"></i>
                        @else
                            <i class="fas fa-star text-gray-300 text-xs"></i>
                        @endif
                    @endfor

                    <span class="text-gray-500 text-xs ml-1">
                        {{ number_format($electronicBook->reviews->avg('rating'), 1) }}
                    </span>
                </div>
                <span class="text-gray-700 text-xs font-medium">
                    ${{ number_format($electronicBook->book->price, 2) }}
                </span>
            </div>
        </div>
    </div>
@endforeach
