@foreach ($posts as $post)
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center gap-4 mb-4">
            <img src="{{ asset('storage/' . optional($post->user)->photo) }}" alt="User Image"
                class="w-10 h-10 rounded-full border-2 border-green-200">
            <div>
                <p class="font-semibold text-green-800">{{ optional($post->user)->name }}</p>
                <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
            </div>
        </div>

        <p class="text-gray-700 mb-4">
            {{ $post->content }}
        </p>

        <img src="{{ asset('storage/' . optional($post)->photo) }}" alt="Post Image"
            class="w-full h-64 object-contain bg-gray-100 rounded-lg mb-4 p-1" loading="lazy">

        <div class="flex items-center justify-between text-gray-600">
            <div class="flex items-center gap-2">
                <button id="like-button-{{ $post->id }}" onclick="toggleLike({{ $post->id }})"
                    class="flex items-center gap-1 hover:text-green-600 transition-colors duration-200 {{ $post->liked_by_user ? 'text-green-600' : '' }} ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                    </svg>
                    <span id="like-count-{{ $post->id }}">
                        {{ $post->likes->count() }} Likes
                    </span>
                </button>
            </div>

            <div class="flex items-center gap-4">
                <button
                    class="flex items-center gap-1 hover:text-green-600 transition-colors duration-200 cursor-default">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                            clip-rule="evenodd" />
                    </svg>
                    <span {{ $post->comments->count() }} Comments </span>
                </button>

            </div>
        </div>
        <hr class="my-6 border-t-2 border-gray-200">

        <div class="mt-6">

            <div id="comments-container-{{ $post->id }}"
                class="max-h-48 overflow-y-auto transition-all duration-300 ease-in-out space-y-4
                                    scrollbar-thin scrollbar-thumb-green-500 scrollbar-track-gray-100 scrollbar-w-1">


                @foreach ($post->comments as $comment)
                    <div class="flex items-start gap-3 mb-2">
                        <img src="{{ asset('storage/' . optional($comment->user)->photo) }}" alt="User Image"
                            class="w-8 h-8 rounded-full border-2 border-green-200">
                        <div class="flex-1">
                            <div class="flex items-center mb-2 gap-2">
                                <p class="text-sm font-semibold text-green-800">
                                    {{ $comment->user->first_name }}
                                </p>
                                <p class="text-xs text-gray-500 leading-tight">
                                    ({{ $comment->created_at->diffForHumans() }})
                                </p>
                            </div>
                            <p class="text-sm text-gray-700">
                                {{ $comment->content }}
                            </p>
                        </div>
                    </div>

                    <div class="border-t border-gray-300 my-2 opacity-30"></div>
                @endforeach
            </div>

            <div class="mt-4 flex items-center gap-2">
                <input id="comment-content-{{ $post->id }}" required type="text" placeholder="Add a comment..."
                    class="flex-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500">
                <button onclick="addComment({{ $post->id }})"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform rotate-180" viewBox="0 0 24 24"
                        fill="currentColor">
                        <path d="M2 12l18-8-5 8 5 8-18-8z" />
                    </svg>
                    {{-- Post Comment --}}
                </button>

            </div>
        </div>
    </div>
@endforeach
