@extends('layouts.main')

@section('title', 'Book Details')

@section('content')
    <section class="bg-gray-100 py-10 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white items-center rounded-xl shadow-lg p-8 flex flex-col lg:flex-row gap-8">

                <div class="flex-1 flex flex-col items-center justify-center">

                    <div class="mb-6 flex justify-center">
                        <img src="{{ asset('storage/' . optional($physicalBook->book->images->first())->image) }}"
                            alt="Book Image" class="w-64 h-80 object-cover rounded-lg large-image">
                    </div>

                    <div class="grid grid-cols-4 gap-4">
                        @foreach ($physicalBook->book->images as $image)
                            <img src="{{ asset('storage/' . optional($image)->image) }}" alt="Thumbnail"
                                class="w-full h-40 object-cover rounded-lg cursor-pointer hover:opacity-80 thumbnail">
                        @endforeach
                    </div>
                </div>


                <div class="flex-1" style="height: fit-content">

                    <h1 class="text-3xl font-extrabold text-gray-800 mb-4">
                        {{ $physicalBook->book->title }}
                    </h1>


                    <div class="flex items-center space-x-2 mb-6">
                        <span class="text-gray-700 text-lg font-bold">
                            {{ $physicalBook->location }}
                        </span>
                    </div>

                    <p class="text-gray-600 mb-6">
                        {{ $physicalBook->book->description }}
                    </p>



                    <div class="mb-8">
                        <span class="block text-2xl font-bold text-gray-800 mb-4">
                            ${{ number_format($physicalBook->book->price, 2) }}
                        </span>
                        <div class="mb-8">
                            <div class="flex items-center gap-4 mb-6">
                                <img src="{{ asset('storage/' . optional($physicalBook->book->seller->user)->photo) }}"
                                    alt="Owner Image" class="w-10 h-10 rounded-full object-cover border-2 border-gray-200">
                                <div>
                                    <p class="text-sm text-gray-600">Book Owner</p>
                                    <p class="text-lg font-semibold text-gray-800">
                                        {{ $physicalBook->book->seller->user->first_name }}
                                        {{ $physicalBook->book->seller->user->last_name }}
                                    </p>
                                </div>
                            </div>

                            <a href="#"
                                class="block w-full bg-green-600 text-white py-2 px-6 rounded-full text-sm font-semibold hover:bg-green-700 transition-colors duration-200 text-center">
                                <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 8V7a2 2 0 00-2-2H5a2 2 0 00-2 2v1M21 8l-9 6-9-6M21 8v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8">
                                    </path>
                                </svg>
                                Send Message
                            </a>
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
@endsection
