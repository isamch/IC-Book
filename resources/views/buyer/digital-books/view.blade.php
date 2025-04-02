{{-- {{ dd($electronicBook->book->seller) }} --}}

@extends('layouts.main')

@section('title', 'Book Details')

@section('content')
    <section class="bg-gray-100 py-10 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Book Details Section -->
            <div class="bg-white items-center rounded-xl shadow-lg p-8 flex flex-col lg:flex-row gap-8">

                <!-- Book Images -->
                <div class="flex-1 flex flex-col items-center justify-center">

                    <div class="mb-6 flex justify-center">
                        <img src="{{ asset('storage/' . optional($electronicBook->book->images->first())->image) }}"
                            alt="Book Image" class="w-64 h-80 object-cover rounded-lg large-image">
                    </div>

                    <div class="grid grid-cols-4 gap-4">

                        @foreach ($electronicBook->book->images as $image)
                            <img src="{{ asset('storage/' . optional($image)->image) }}" alt="Thumbnail"
                                class="w-full h-40 object-cover rounded-lg cursor-pointer hover:opacity-80 thumbnail">
                        @endforeach
                    </div>
                </div>


                <div class="flex-1" style="height: fit-content">
                    <h1 class="text-3xl font-extrabold text-gray-800 mb-4">
                        {{ $electronicBook->book->title }}
                    </h1>
                    <div class="flex items-center space-x-2 mb-6">
                        <div class="flex items-center">

                            @for ($i = 0; $i < 5; $i++)
                                @if ($i < $electronicBook->reviews->avg('rating'))
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
                        <span class="text-gray-500 text-sm">
                            {{ number_format($electronicBook->reviews->avg('rating'), 1) }}
                        </span>
                    </div>

                    <p class="text-gray-600 mb-6">
                        {{ $electronicBook->book->description }}
                    </p>


                    <div class="block text-center mb-8">
                        <div class="flex items-center gap-4 mb-6">
                            <img src="{{ asset('storage/' . optional($electronicBook->book->seller->user)->photo ) }}"
                                alt="Owner Image" class="w-10 h-10 rounded-full object-cover border-2 border-gray-200">
                            <div>
                                <p class="text-lg font-semibold text-gray-800">
                                    {{ $electronicBook->book->seller->user->first_name }}
                                    {{ $electronicBook->book->seller->user->last_name }}
                                </p>
                            </div>
                        </div>

                        <span class="text-2xl font-bold text-gray-800 block mb-4">
                            ${{ number_format($electronicBook->book->price, 2) }}
                        </span>

                        <button
                            class="w-full bg-green-600 text-white py-2 rounded-full text-sm font-semibold hover:bg-green-700 transition-colors duration-200 flex items-center justify-center">
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

                @if (!$hasRating)

                    <div id="user-info" data-first-name="{{ Auth::user()->first_name }}"
                        data-last-name="{{ Auth::user()->last_name }}" data-book-id="{{ $electronicBook->id }}"></div>

                    <div class="mt-4" id="add-review">
                        <h3 class="text-base font-bold text-gray-700 mb-4">Add Your Rating</h3>
                        <div class="flex items-start space-x-4">
                            <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                                <span class="text-gray-600 font-semibold">
                                    {{ strtoupper(Str::substr(Auth::user()->first_name, 2, 5)) }}
                                </span>
                            </div>
                            <div class="flex-1 flex flex-col gap-4">
                                <div class="flex items-center space-x-2">
                                    <span class="text-gray-600">Your Rating:</span>
                                    <div class="flex space-x-1" id="starRating">

                                        @for ($i = 1; $i <= 5; $i++)
                                            <button type="button"
                                                class="text-gray-300 hover:text-yellow-400 focus:outline-none star"
                                                data-rating="{{ $i }}">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.364 1.118l1.518 4.674c.3.921-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.364-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.915a1 1 0 00.95-.69l1.519-4.674z">
                                                    </path>
                                                </svg>
                                            </button>
                                        @endfor
                                    </div>
                                </div>
                                <textarea id="comment-review" name="comment" rows="2"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 shadow-sm resize-none"
                                    placeholder="Write your review..."></textarea>


                                <button type="submit" id="submit-reviews"
                                    class="whitespace-nowrap w-full md:w-auto bg-green-600 text-white py-2 px-6 rounded-full text-sm font-semibold hover:bg-green-700 transition-colors duration-200 shadow-md">
                                    Submit Review
                                </button>


                            </div>


                        </div>
                    </div>

                    <div class="w-full h-px bg-gradient-to-r from-transparent via-gray-300 to-transparent my-5"></div>

                @endif


                <!-- Reviews List -->
                <div class="space-y-6 mt-4">
                    <h3 class="text-base font-bold text-gray-700 mb-4">Customer Reviews</h3>

                    <div id="reviews-list"
                        class="max-h-96 overflow-y-auto scrollbar-thin scrollbar-thumb-green-500 scrollbar-track-gray-100"
                        style="overflow-y: auto; scrollbar-width: thin; scrollbar-color: #48bb78 #f7fafc;">

                        @foreach ($electronicBook->reviews as $review)
                            <div class="border-b border-gray-200 p-6">

                                <div class="flex items-start space-x-4">

                                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                                        <span class="text-gray-600 font-semibold">
                                            {{ Str::limit($review->buyer->user->first_name, 1, '') }}
                                        </span>
                                    </div>

                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <h4 class="text-lg font-semibold text-gray-800">
                                                {{ $review->buyer->user->first_name }}
                                                {{ $review->buyer->user->last_name }}
                                            </h4>
                                            <span class="text-sm text-gray-500">
                                                {{ $review->created_at->diffForHumans() }}
                                            </span>
                                        </div>

                                        <div class="flex items-center space-x-1 mt-2">


                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < $review->rating)
                                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                                @else
                                                    <i class="fas fa-star text-gray-300 text-xs"></i>
                                                @endif
                                            @endfor


                                            <span class="text-sm text-gray-500">
                                                {{ number_format($review->rating, 1) }}
                                            </span>
                                        </div>

                                        <style>
                                            details[open] summary {
                                                display: none;
                                            }
                                        </style>
                                        <details class="mt-2">
                                            <summary class="list-none cursor-pointer text-gray-600 hover:text-green-600">
                                                {{ Str::limit($review->comment, 50, '...') }}
                                            </summary>
                                            <p class="text-gray-600 mt-2">
                                                {{ $review->comment }}
                                            </p>
                                        </details>
                                    </div>

                                </div>
                            </div>
                        @endforeach

                        <!-- Show More Button -->
                        {{-- <div class="text-center mt-4">
                            <button
                                class="bg-green-600 text-white py-2 px-6 rounded-full text-sm font-semibold hover:bg-green-700 transition-colors duration-200">
                                Show More
                            </button>
                        </div> --}}

                    </div>
                </div>



            </div>


        </div>
    </section>


    <div id="success-alert"
        class="alert-reviews fixed top-4 right-4 border px-6 py-4 rounded-lg shadow-xl transition-opacity duration-500 ease-in-out z-50 max-w-sm w-full flex items-center space-x-4 hidden">

        <div class="flex-grow">
            <div id="alert-message"></div>
        </div>

        <button class="text-yellow-700 focus:outline-none" onclick="closeAlert('success-alert')">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <script>
        function showAlert(message, type) {
            const alert = document.querySelector('.alert-reviews');
            const alertMessage = document.getElementById('alert-message');

            alert.classList.remove("bg-green-100");
            alert.classList.remove("border-green-400");
            alert.classList.remove("text-green-700");

            alert.classList.remove("bg-yellow-100");
            alert.classList.remove("border-yellow-400");
            alert.classList.remove("text-yellow-700");

            alert.classList.remove("bg-red-100");
            alert.classList.remove("border-red-400");
            alert.classList.remove("text-red-700");

            if (type == "success") {
                alert.classList.add("bg-green-100");
                alert.classList.add("border-green-400");
                alert.classList.add("text-green-700");
                alertMessage.textContent = `Success: ${message}`;
            } else if (type == "danger") {
                alert.classList.add("bg-yellow-100");
                alert.classList.add("border-yellow-400");
                alert.classList.add("text-yellow-700");
                alertMessage.textContent = `Error: ${message}`;
            } else if (type == "warning") {
                alert.classList.add("bg-red-100");
                alert.classList.add("border-red-400");
                alert.classList.add("text-red-700");
                alertMessage.textContent = `Warning: ${message}`;
            }

            alert.classList.remove('hidden');

        }
    </script>


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
        let selectedRating = 0;
        const userInfo = document.getElementById('user-info');
        const firstName = userInfo.getAttribute('data-first-name');
        const lastName = userInfo.getAttribute('data-last-name');
        const bookId = userInfo.getAttribute('data-book-id');


        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star');
            const starRatingContainer = document.getElementById('starRating');


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

                });
            });
        });



        function appendCommentReview(comment) {


            function getStars(rating) {
                let stars = '';
                for (let i = 0; i < 5; i++) {
                    if (i < rating) {
                        stars += `<i class="fas fa-star text-yellow-400 text-xs"></i>`;
                    } else {
                        stars += `<i class="fas fa-star text-gray-300 text-xs"></i>`;
                    }
                }
                return stars;
            }


            const reviewDiv = document.createElement('div');
            reviewDiv.classList.add('border-b', 'border-gray-200', 'p-6');

            reviewDiv.innerHTML = `
                <div class="flex items-start space-x-4">
                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                        <span class="text-gray-600 font-semibold">${firstName[0]}</span>
                    </div>

                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <h4 class="text-lg font-semibold text-gray-800">${firstName} ${lastName}</h4>
                            <span class="text-sm text-gray-500">Just now</span>
                        </div>

                        <div class="flex items-center space-x-1 mt-2">
                            ${getStars(selectedRating)}
                            <span class="text-sm text-gray-500">${selectedRating.toFixed(1)}</span>
                        </div>

                        <details class="mt-2">
                            <summary class="list-none cursor-pointer text-gray-600 hover:text-green-600">
                                ${comment.substring(0, 10)}...
                            </summary>
                            <p class="text-gray-600 mt-2">
                                ${comment}
                            </p>
                        </details>
                    </div>
                </div>
            `;


            const reviewsList = document.getElementById('reviews-list');
            reviewsList.prepend(reviewDiv);

        }




        function submitReview() {
            const comment = document.getElementById('comment-review').value;
            fetch(`/books/${bookId}/reviews/create`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        selectedRating,
                        comment,
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {


                        appendCommentReview(comment);

                        document.getElementById('add-review').remove();

                        showAlert("Rating added successfully!", "success");


                    } else {
                        showAlert("An error occurred while adding the rating.", "danger");
                    }

                })
                .catch(error => {
                    showAlert("An error occurred while connecting to the server.", "danger");

                });

        }


        document.getElementById('submit-reviews').addEventListener('click', submitReview);
    </script>






@endsection
