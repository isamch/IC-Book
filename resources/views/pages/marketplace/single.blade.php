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

                <!-- Book Info -->
                <div class="flex-1" style="height: fit-content">

                    <!-- Title -->
                    <h1 class="text-3xl font-extrabold text-gray-800 mb-4">Book Title</h1>


                    <!-- Rating -->
                    <div class="flex items-center space-x-2 mb-6">
                        <span class="text-gray-700 text-lg font-bold">Rabat</span>
                    </div>

                    <!-- Description -->
                    <p class="text-gray-600 mb-6">
                        This is a detailed description of the book. It provides an overview of the content, the author's
                        perspective, and why it's a must-read. The description is engaging and informative, encouraging
                        potential readers to dive into the book.
                    </p>

                    <!-- Price and Buy Button -->
                    <div class="mb-8">
                        <span class="block text-2xl font-bold text-gray-800 mb-4">$29.99</span>
                        <div class="mb-8">
                            <div class="flex items-center gap-4 mb-6">
                                <img src="{{ asset('storage/images/profile/default/default-profile.png') }}"
                                    alt="Owner Image" class="w-10 h-10 rounded-full object-cover border-2 border-gray-200">
                                <div>
                                    <p class="text-sm text-gray-600">Book Owner</p>
                                    <p class="text-lg font-semibold text-gray-800">John Doe</p>
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
        // تغيير الصورة الكبيرة عند النقر على الصور الصغيرة
        document.addEventListener('DOMContentLoaded', function() {
            const largeImage = document.querySelector('.large-image'); // الصورة الكبيرة
            const thumbnails = document.querySelectorAll('.thumbnail'); // الصور الصغيرة

            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener('click', function() {
                    largeImage.src = this.src; // تغيير الصورة الكبيرة
                });
            });
        });
    </script>
@endsection
