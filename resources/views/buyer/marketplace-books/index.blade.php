@extends('layouts.main')

@section('title', 'Marketplace')

@section('content')
    <section class="bg-gray-100 py-10 px-4">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-4xl font-extrabold text-center text-gray-800 mb-16 relative">
                <a href="#products" class="relative z-10 cursor-pointer">MarketPlace</a>
                <span
                    class="absolute left-1/2 transform -translate-x-1/2 -bottom-4 w-24 h-1.5 bg-green-500 rounded-full"></span>
                <span
                    class="absolute left-1/2 transform -translate-x-1/2 -bottom-6 w-16 h-1.5 bg-green-400 rounded-full opacity-50"></span>
            </h2>
            <div class="w-full h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent my-12"></div>

            <div class="flex flex-col lg:flex-row gap-8">
                <div class="w-full lg:w-1/4 bg-white rounded-xl shadow-lg p-6"
                    style="height: 800px; overflow-y: auto; scrollbar-width: thin; scrollbar-color: #48bb78 #f7fafc;">

                    <!-- Apply Filter Button -->
                    <button id="apply-filter"
                        class="w-full bg-green-600 text-white py-2 px-4 rounded-lg mb-6 hover:bg-green-700 transition-colors duration-200">
                        Apply Filter
                    </button>

                    <!-- Search Bar -->
                    <div class="mb-6">
                        <input id="search-filter" type="text" placeholder="Search products..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>



                    <div class="space-y-6">


                        <div class="relative w-full max-w-md mx-auto">
                            <h4 class="text-lg font-medium text-gray-800 mb-3">Places</h4>
                            <input type="text" id="searchCities" placeholder="search about city ..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-gray-800 bg-white mb-4">

                            <select id="dropdownResults"
                                class="w-full px-4 py-2 border border-green-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-gray-800 bg-white transition-colors duration-300 ease-in-out"
                                size="5">

                                <!-- Default option -->
                                <option value="All-location" selected class="text-gray-800 hover:bg-green-100 py-1">All
                                </option>

                                <!-- Loop through locations -->
                                @foreach ($locations as $location)
                                    <option value="{{ $location }}" class="text-gray-800 hover:bg-green-100 py-1">
                                        {{ ucfirst($location) }}</option>
                                @endforeach

                            </select>
                        </div>




                        <!-- Category Filter -->
                        <div>
                            <h4 class="text-lg font-medium text-gray-800 mb-3">Categories</h4>
                            <ul class="space-y-2 max-h-48 overflow-y-auto"
                                style="scrollbar-width: thin; scrollbar-color: #48bb78 #f7fafc;">
                                <li>
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" value="all-categories" checked
                                            class="checkbox-category form-checkbox h-4 w-4 text-green-600 rounded focus:ring-green-500">
                                        <span class="text-gray-600">
                                            All
                                        </span>
                                    </label>
                                </li>

                                @foreach ($categories as $category)
                                    <li>
                                        <label class="flex items-center space-x-2">
                                            <input type="checkbox" value="{{ $category->name }}"
                                                class="checkbox-category form-checkbox h-4 w-4 text-green-600 rounded focus:ring-green-500">
                                            <span class="text-gray-600">
                                                {{ $category->name }}
                                            </span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>


                        <div class="mt-6">
                            <h4 class="text-lg font-medium text-gray-800 mb-3">Price Range</h4>

                            <ul class="space-y-2 max-h-48 overflow-y-auto"
                                style="scrollbar-width: thin; scrollbar-color: #48bb78 #f7fafc;">

                                <li>
                                    <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50  rounded">
                                        <input type="radio" name="price-range" value="all-prices" checked
                                            class="form-radio h-4 w-4 text-green-600 focus:ring-green-500">
                                        <span class="text-gray-600">All Prices</span>
                                    </label>
                                </li>

                                <li>
                                    <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 rounded">
                                        <input type="radio" name="price-range" value="0-50"
                                            class="form-radio h-4 w-4 text-green-600 focus:ring-green-500">
                                        <span class="text-gray-600">Under $50</span>
                                    </label>
                                </li>

                                <li>
                                    <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 rounded">
                                        <input type="radio" name="price-range" value="50-100"
                                            class="form-radio h-4 w-4 text-green-600 focus:ring-green-500">
                                        <span class="text-gray-600">$50 - $100</span>
                                    </label>
                                </li>

                                <li>
                                    <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 rounded">
                                        <input type="radio" name="price-range" value="100-200"
                                            class="form-radio h-4 w-4 text-green-600 focus:ring-green-500">
                                        <span class="text-gray-600">$100 - $200</span>
                                    </label>
                                </li>

                                <li>
                                    <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 rounded">
                                        <input type="radio" name="price-range" value="200-999999"
                                            class="form-radio h-4 w-4 text-green-600 focus:ring-green-500">
                                        <span class="text-gray-600">Over $200</span>
                                    </label>
                                </li>
                            </ul>
                        </div>




                    </div>
                </div>

                <!-- Product Grid -->
                <div class="w-full lg:w-3/4 bg-white rounded-xl shadow-lg p-6"
                    style="height: 800px; overflow-y: auto; scrollbar-width: thin; scrollbar-color: #48bb78 #f7fafc;">

                    <div id="container-card" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 grid-container">


                        @foreach ($physicalBooks as $physicalBook)
                            <div
                                class="bg-white rounded-md shadow-md overflow-hidden transform transition-all duration-300 hover:shadow-lg hover:-translate-y-1">


                                <div class="relative">
                                    <img src="{{ asset('storage/' . optional($physicalBook->book->images->first())->image) }}"
                                        alt="{{ $physicalBook->book->title }}"
                                        class="w-full h-60 object-cover object-center">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-80 flex items-end p-3">
                                        <a href="#"
                                            class="inline-flex items-center bg-green-600 text-white py-1.5 px-4 rounded-full text-xs font-semibold hover:bg-green-800 transition-colors duration-100">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
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

                    </div>

                    <!-- Show More Button -->
                    <div class="text-center pt-8">
                        <button id="load-more"
                            class="inline-flex items-center bg-transparent text-gray-600 border border-gray-600 py-2 px-6 rounded-full text-sm font-medium hover:bg-gray-100 hover:text-gray-700 transition-colors duration-200">
                            Show More Products
                        </button>
                    </div>
                </div>


            </div>
        </div>
    </section>


    {{-- js for search about city --}}
    <script>
        function filterCities() {
            const searchInput = document.getElementById('searchCities');
            const dropdown = document.getElementById('dropdownResults');
            const options = dropdown.getElementsByTagName('option');

            const searchQuery = searchInput.value.toLowerCase();

            Array.from(options).forEach(option => {
                const cityName = option.textContent.toLowerCase();

                if (cityName.includes(searchQuery)) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });
        }

        document.getElementById('searchCities').addEventListener('input', filterCities);
    </script>



    <script>
        let offset = 2;
        const containerBooks = document.getElementById('container-card');
        const loadMoreBtn = document.getElementById('load-more');

        const fetchBooks = (url, callback) => {
            fetch(url, {
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => callback(data))
                .catch(() => showError());
        };


        const updateBooks = (data) => {

            loadMoreBtn.disabled = false;
            loadMoreBtn.textContent = "Load More...";

            containerBooks.querySelectorAll('.spiner-load').forEach(e => e.remove());

            if (data.html) {
                containerBooks.innerHTML += data.html;
            } else {
                loadMoreBtn.disabled = true;
                loadMoreBtn.textContent = "No additional items available";
            }
        };


        const showLoadingSpinner = () => {
            containerBooks.innerHTML += `
            <div class="spiner-load flex justify-center items-center h-40">
                <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-green-500"></div>
            </div>`;
        };

        const showError = () => {
            containerBooks.innerHTML += `
            <div class="text-center py-12 text-red-500">
                <i class="h-16 w-16 mx-auto fas fa-exclamation-circle"></i>
                <h3 class="mt-4 text-lg font-medium">Error loading content</h3>
                <p class="mt-1 text-sm">Error loading content</p>
            </div>`;
        };


        const getFilterData = () => ({
            search: document.querySelector('#search-filter').value,
            categories: Array.from(document.querySelectorAll('.checkbox-category:checked')).map(e => e.value),
            price: document.querySelector('input[name="price-range"]:checked')?.value || '',
            location: document.getElementById('dropdownResults').value,
        });



        loadMoreBtn.addEventListener('click', () => {

            showLoadingSpinner();

            let params = new URLSearchParams(window.location.search);

            let url = `/marketplace/books/load-more/${offset}?${params.toString()}`;

            fetchBooks(url, updateBooks);

            offset += 2;
        });


        document.getElementById('apply-filter').addEventListener('click', () => {

            offset = 2;

            const filterData = getFilterData();

            const newUrl =
                `/marketplace/books/filter?search=${filterData.search}&category=${filterData.categories.join(',')}&price=${filterData.price}&location=${filterData.location}`;

            history.pushState({
                path: newUrl
            }, '', newUrl);


            fetchBooks(newUrl, (data) => {

                containerBooks.innerHTML = '';

                updateBooks(data);

            });

        });
    </script>

@endsection
