@foreach ($physicalBooks as $physicalBook)
    <div
        class="bg-white rounded-md shadow-md overflow-hidden transform transition-all duration-300 hover:shadow-lg hover:-translate-y-1">


        <div class="relative">
            <img src="{{ asset('storage/' . optional($physicalBook->book->images->first())->image) }}"
                alt="{{ $physicalBook->book->title }}" class="w-full h-60 object-cover object-center">
            <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-80 flex items-end p-3">
                <a href="{{ route('buyer.marketplace.books.show', $physicalBook->id) }}"
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

                <a href="#" class="text-gray-900 hover:text-green-500 cursor-pointer">
                    {{ $physicalBook->book->title }}
                </a>
            </h4>

            <p class="text-gray-600 text-xs mb-3 line-clamp-2">
                {{ Str::limit($physicalBook->book->description, 50, '...') }}
            </p>

            <div class="flex items-center justify-between">
                <span class="text-gray-700 text-sm font-medium">
                    {{ $physicalBook->location }}
                </span>
                <span class="text-gray-700 text-xs font-medium">

                    ${{ number_format($physicalBook->book->price, 2) }}
                </span>
            </div>
        </div>
    </div>
@endforeach
