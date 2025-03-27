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
                <a href="{{ route('seller.books.index') }}" class="flex items-center gap-3 p-3 rounded-lg bg-green-700">
                    <i class="fas fa-file-pdf"></i>
                    <span>Digital Books</span>
                </a>
                <a href="{{ route('seller.marketplace.books.index') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700">
                    <i class="fas fa-book"></i>
                    <span>Physical Books</span>
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
                        <a href="{{ route('seller.profile.show', auth()->user()->id) }}" class="flex items-center gap-2">
                            <img src="{{ asset('storage/' . optional(auth()->user())->photo) }}" alt="Admin" class="w-8 h-8 rounded-full">
                            <span class="font-medium">{{ auth()->user()->first_name }}</span>
                        </a>
                    </div>
                </div>
            </div>


            {{-- other content here --}}


            <div class="rounded-xl p-6">


                <!-- Main form container -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <!-- Form header -->
                    <div class="bg-green-800 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white">Add Book Information</h3>
                    </div>

                    <form class="p-6" id="editBookForm" method="POST" action="{{ route('seller.books.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                            <!-- Image Upload Section (4 Images) -->
                            <div class="col-span-1">
                                <div class="grid grid-cols-2 gap-4">
                                    @for ($i = 1; $i <= 4; $i++)
                                        <div class="relative" id="imageContainer{{ $i }}">
                                            <img id="preview{{ $i }}"
                                                src="{{ asset('storage/images/books/default/cover/upload-image.avif') }}"
                                                class="w-32 h-32 object-cover rounded-lg shadow-md border border-gray-200">
                                            <input type="file" id="upload{{ $i }}" name="images[]"
                                                class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*"
                                                onchange="previewImage(this, 'preview{{ $i }}')">
                                        </div>
                                    @endfor
                                </div>
                                @error('images.*')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                @error('images')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Book details form -->
                            <div class="col-span-1 md:col-span-2 space-y-6">
                                <!-- Title -->
                                <div>
                                    <label for="bookTitle" class="block text-sm font-medium text-gray-700">Title*</label>
                                    <input type="text" id="bookTitle" name="title" value="{{ old('title') }}" required
                                        class="mt-1 block w-full border-b border-gray-300 focus:border-green-500 focus:ring-0 outline-none sm:text-sm @error('title') border-red-500 @enderror">
                                    @error('title')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Author and Price -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label for="bookAuthor"
                                            class="block text-sm font-medium text-gray-700">Author*</label>
                                        <input type="text" id="bookAuthor" name="author" value="{{ old('author') }}"
                                            required
                                            class="mt-1 block w-full border-b border-gray-300 focus:border-green-500 focus:ring-0 outline-none sm:text-sm @error('author') border-red-500 @enderror">
                                        @error('author')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="bookPrice"
                                            class="block text-sm font-medium text-gray-700">Price*</label>
                                        <div class="relative">
                                            <span
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">$</span>
                                            <input type="number" id="bookPrice" name="price" value="{{ old('price') }}"
                                                step="0.01" min="0" required
                                                class="mt-1 block w-full pl-7 border-b border-gray-300 focus:border-green-500 focus:ring-0 outline-none sm:text-sm @error('price') border-red-500 @enderror">
                                        </div>
                                        @error('price')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Description -->
                                <div>
                                    <label for="bookDescription"
                                        class="block text-sm font-medium text-gray-700">Description*</label>
                                    <textarea id="bookDescription" name="description" rows="3" required
                                        class="mt-1 block w-full border-b border-gray-300 focus:border-green-500 focus:ring-0 outline-none sm:text-sm @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- File Upload -->
                                <div>
                                    <label for="bookFile" class="block text-sm font-medium text-gray-700">Upload
                                        File*</label>
                                    <div
                                        class="relative border border-gray-300 rounded-lg p-2 flex items-center cursor-pointer hover:border-green-500 transition-colors duration-200 @error('book_file') border-red-500 @enderror">
                                        <svg class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                        <span id="fileLabel" class="text-gray-500 text-sm truncate">
                                            {{ old('book_file') ? old('book_file') : 'No file chosen' }}
                                        </span>
                                        <input type="file" id="bookFile" name="book_file" required
                                            accept=".pdf,.doc,.docx" class="absolute inset-0 opacity-0 cursor-pointer"
                                            onchange="document.getElementById('fileLabel').textContent = this.files[0]?.name || 'No file chosen'">
                                    </div>
                                    @error('book_file')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">Supported formats: PDF, DOC, DOCX (Max 10MB)</p>
                                </div>
                            </div>
                        </div>

                        <!-- Form footer -->
                        <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-4">
                            <a href="{{ route('seller.books.index') }}"
                                type="button"
                                class="px-6 py-2 border border-gray-300 rounded-lg text-base font-medium text-gray-700 hover:bg-gray-100 focus:outline-none">
                                Cancel
                            </a>
                            <button type="submit"
                                class="px-6 py-2 bg-green-600 rounded-lg text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Store Book
                            </button>
                        </div>
                    </form>


                </div>

                <!-- Image Preview Script -->
                <script>
                    function previewImage(inputId, imgId) {
                        document.getElementById(inputId).addEventListener("change", function(e) {
                            const file = e.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(event) {
                                    document.getElementById(imgId).src = event.target.result;
                                };
                                reader.readAsDataURL(file);
                            }
                        });
                    }

                    previewImage("upload1", "preview1");
                    previewImage("upload2", "preview2");
                    previewImage("upload3", "preview3");
                    previewImage("upload4", "preview4");


                    // for upload file:
                    document.getElementById('bookFile').addEventListener('change', function() {

                        const fileName = this.files.length > 0 ? this.files[0].name : "No file chosen";
                        document.getElementById('fileLabel').textContent = fileName;

                    });
                </script>











            </div>
        </div>


    @endsection
