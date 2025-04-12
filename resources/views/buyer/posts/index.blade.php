@extends('layouts.posts')

@section('title', 'Posts')

@section('content')
    <div class="min-h-screen bg-gray-50 flex flex-col">

        <!-- Fixed Post Creation Form -->
        <div class="bg-gray-50 pt-3 pb-2 px-3">

            <div class="max-w-2xl mx-auto">
                <div class="flex items-center justify-between mb-2">
                    <h1 class="text-lg font-bold text-gray-900">
                        <span class="inline-block border-b-2 border-green-500">Feed</span>
                    </h1>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-3">
                    <form action="{{ route('buyer.posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="flex items-start gap-2">
                            <img src="{{ asset('storage/' . optional(Auth::user())->photo) }}" alt="Profile"
                                class="w-8 h-8 rounded-full object-cover ring-1 ring-green-100">

                            <div class="flex-1">
                                <textarea name="content" required
                                    placeholder="What's on your mind {{ optional(Auth::user())->first_name }}?"
                                    class="w-full p-2 text-sm border border-gray-200 rounded-lg focus:outline-none
                                    focus:ring-1 focus:ring-green-500 focus:border-transparent resize-none transition-all
                                    duration-200 min-h-[40px] max-h-[80px] text-gray-700 placeholder-gray-400
                                    @error('content') border-red-400 focus:ring-red-500 @enderror"></textarea>

                                @error('content')
                                    <span class="block mt-1 text-red-500 text-xs">{{ $message }}</span>
                                @enderror

                                <input type="file" name="photo" class="hidden" id="attachment" accept="image/*"
                                    onchange="previewImage(event)">

                                @error('photo')
                                    <span class="block mt-1 text-red-500 text-xs">{{ $message }}</span>
                                @enderror

                                <div id="image-preview" class="mt-2 max-w-full rounded-lg overflow-hidden"></div>

                                <div class="flex items-center justify-between mt-2">
                                    <div class="flex items-center gap-1">
                                        <label for="attachment"
                                            class="flex items-center gap-1 px-2 py-1 rounded-md text-gray-600 hover:bg-gray-100 transition-colors duration-200 cursor-pointer text-xs">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span class="font-medium">Photo</span>
                                        </label>

                                        <button type="button" onclick="clearAttachment()" id="clear-attach"
                                            class="hidden flex items-center gap-1 px-2 py-1 rounded-md text-red-600 hover:bg-red-50 transition-colors duration-200 text-xs">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            <span class="font-medium">Remove</span>
                                        </button>
                                    </div>

                                    <button type="submit"
                                        class="px-3 py-1 bg-green-600 text-white rounded-md text-xs font-medium hover:bg-green-700 transition-all duration-200 shadow-sm hover:shadow flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                        </svg>
                                        <span>Share</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Scrollable Posts Feed -->
        <div class="flex-1 overflow-hidden">
            <div class="max-w-2xl mx-auto px-3">
                <!-- Feed Divider -->
                <div class="relative my-3">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="bg-gray-50 px-2 text-xs text-gray-500">Recent Posts</span>
                    </div>
                </div>

                <!-- Scrollable Posts Container -->
                <div id="posts-container" class="overflow-y-auto pb-4" style="height: calc(100vh - 180px);">
                    <div class="space-y-3">
                        @foreach ($posts as $post)
                            <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-md">
                                <!-- Post Header -->
                                <div class="p-3">
                                    <div class="flex items-center gap-2 group">
                                        <a href="{{ route('buyer.profile.show', $post->user->id) }}"
                                            class="relative">
                                            <img src="{{ asset('storage/' . optional($post->user)->photo) }}" alt="Profile"
                                                class="w-8 h-8 rounded-full object-cover ring-1 ring-green-100 group-hover:ring-green-300 transition-all duration-200">
                                            <div class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 bg-green-500 rounded-full border border-white"></div>
                                        </a>

                                        <a href="{{ route('buyer.profile.show', $post->user->id) }}"
                                            <p class="font-medium text-sm text-gray-800 group-hover:text-green-600 transition-colors duration-200">
                                                {{ optional($post->user)->first_name }}
                                                {{ optional($post->user)->last_name }}
                                            </p>
                                            <div class="flex items-center gap-1">
                                                <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                                            </div>
                                        </a>
                                    </div>

                                    <!-- Post Content -->
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-700 whitespace-pre-line">
                                            {{ $post->content }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Post Image (if exists) -->
                                @if($post->photo)
                                    <div class="border-t border-b border-gray-100">
                                        <img src="{{ asset('storage/' . optional($post)->photo) }}" alt="Post Image"
                                            class="w-full max-h-[300px] object-contain bg-gray-50" loading="lazy">
                                    </div>
                                @endif

                                <!-- Post Stats -->
                                <div class="px-3 py-2 flex items-center justify-between text-gray-500 text-xs">
                                    <div class="flex items-center gap-1">
                                        <div class="flex -space-x-1">
                                            <div class="w-5 h-5 rounded-full bg-green-500 flex items-center justify-center text-white text-xs shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-2.5 w-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                                </svg>
                                            </div>
                                        </div>
                                        <span id="like-count-{{ $post->id }}">
                                            {{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <span>{{ $post->comments->count() }} {{ Str::plural('comment', $post->comments->count()) }}</span>
                                    </div>
                                </div>

                                <!-- Post Actions -->
                                <div class="px-3 py-1 border-t border-gray-100 flex items-center justify-between">
                                    <button id="like-button-{{ $post->id }}" onclick="toggleLike({{ $post->id }})"
                                        class="flex items-center justify-center gap-1 py-1 px-2 rounded-md hover:bg-gray-50 transition-colors duration-200 w-1/2 {{ $post->liked_by_user ? 'text-green-600' : 'text-gray-600' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                        </svg>
                                        <span class="font-medium text-xs">Like</span>
                                    </button>
                                    <div class="h-6 w-px bg-gray-200"></div>
                                    <button class="flex items-center justify-center gap-1 py-1 px-2 rounded-md hover:bg-gray-50 transition-colors duration-200 w-1/2 text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                        <span class="font-medium text-xs">Comment</span>
                                    </button>
                                </div>

                                <!-- Comments Section -->
                                <div class="px-3 py-2 bg-gray-50 border-t border-gray-100">
                                    <!-- Comments List -->
                                    <div id="comments-container-{{ $post->id }}"
                                        class="max-h-40 overflow-y-auto space-y-2 pr-1 scrollbar-thin scrollbar-thumb-green-500 scrollbar-track-gray-100 scrollbar-w-1 mb-2">
                                        @foreach ($post->comments as $comment)
                                            <div class="flex items-start gap-2">
                                                <img src="{{ asset('storage/' . optional($comment->user)->photo) }}"
                                                    alt="User Image" class="w-6 h-6 rounded-full object-cover ring-1 ring-green-100 mt-1">
                                                <div class="flex-1 bg-white p-2 rounded-md shadow-sm">
                                                    <div class="flex items-center gap-1 mb-0.5">
                                                        <p class="text-xs font-medium text-gray-800">
                                                            {{ $comment->user->first_name }}
                                                        </p>
                                                        <p class="text-[10px] text-gray-500">
                                                            {{ $comment->created_at->diffForHumans() }}
                                                        </p>
                                                    </div>
                                                    <p class="text-xs text-gray-700">
                                                        {{ $comment->content }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Add Comment -->
                                    <div class="flex items-center gap-2">
                                        <img src="{{ asset('storage/' . optional(Auth::user())->photo) }}" alt="Profile"
                                            class="w-6 h-6 rounded-full object-cover ring-1 ring-green-100">
                                        <div class="flex-1 relative">
                                            <input id="comment-content-{{ $post->id }}" type="text"
                                                placeholder="Write a comment..."
                                                class="w-full py-1 pl-3 pr-8 border border-gray-200 rounded-full focus:outline-none focus:ring-1 focus:ring-green-500 focus:border-transparent text-xs">
                                            <button onclick="addComment({{ $post->id }})"
                                                class="absolute right-1.5 top-1/2 transform -translate-y-1/2 text-green-500 hover:text-green-600 transition-colors duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Load More Button -->
                        <div id="load-more-container" class="text-center py-4">
                            <button id="load-more-posts"
                                class="inline-flex items-center gap-1 bg-white text-gray-700 border border-gray-300 py-1.5 px-4 rounded-full text-xs font-medium hover:bg-gray-50 transition-all duration-200 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                                <span>Load More</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            document.getElementById('clear-attach').classList.remove('hidden');
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('image-preview');
                output.innerHTML =
                    `<div class="relative group">
                        <img src="${reader.result}" alt="Selected Image" class="w-full h-auto max-h-40 object-cover rounded-md border border-gray-200">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-200 rounded-md"></div>
                     </div>`;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function clearAttachment() {
            document.getElementById('clear-attach').classList.add('hidden');
            const attachmentInput = document.getElementById('attachment');
            const imagePreview = document.getElementById('image-preview');
            attachmentInput.value = '';
            imagePreview.innerHTML = '';
        }

        function toggleLike(postId) {
            fetch(`/posts/${postId}/like`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const likeButton = document.getElementById(`like-button-${postId}`);
                    const likeCount = document.getElementById(`like-count-${postId}`);

                    if (data.liked) {
                        likeButton.classList.add('text-green-600');
                        likeButton.classList.remove('text-gray-600');
                    } else {
                        likeButton.classList.remove('text-green-600');
                        likeButton.classList.add('text-gray-600');
                    }

                    likeCount.textContent = `${data.count} ${data.count === 1 ? 'like' : 'likes'}`;
                })
                .catch(error => console.error('Error:', error));
        }

        function createCommentHTML(photo, firstName, content) {
            return `
                <div class="flex items-start gap-2">
                    <img src="/storage/${photo}" alt="User Image" class="w-6 h-6 rounded-full object-cover ring-1 ring-green-100 mt-1">
                    <div class="flex-1 bg-white p-2 rounded-md shadow-sm">
                        <div class="flex items-center gap-1 mb-0.5">
                            <p class="text-xs font-medium text-gray-800">${firstName}</p>
                            <p class="text-[10px] text-gray-500">just now</p>
                        </div>
                        <p class="text-xs text-gray-700">${content}</p>
                    </div>
                </div>
            `;
        }

        function addComment(postId) {
            const content = document.getElementById(`comment-content-${postId}`).value;

            if (!content.trim()) {
                return;
            }

            fetch(`/posts/${postId}/comment/create`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        content: content
                    })
                })
                .then(response => response.json())
                .then(data => {
                    const commentsContainer = document.getElementById(`comments-container-${postId}`);
                    if (commentsContainer) {
                        const newCommentHTML = createCommentHTML(data.user.photo, data.user.first_name, data.comment.content);
                        commentsContainer.insertAdjacentHTML('afterbegin', newCommentHTML);
                    }

                    const commentInput = document.getElementById(`comment-content-${postId}`);
                    if (commentInput) {
                        commentInput.value = '';
                    }
                })
                .catch(error => console.error('Error adding comment:', error));
        }

        let offset = 2;
        const containerPosts = document.getElementById('posts-container');
        const loadMoreBtn = document.getElementById('load-more-posts');

        const fetchPosts = (url, callback) => {
            fetch(url, {
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => callback(data))
                .catch(() => showError());
        };

        const updatePosts = (data) => {
            loadMoreBtn.disabled = false;
            loadMoreBtn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
                <span>Load More</span>
            `;

            containerPosts.querySelectorAll('.spinner-load').forEach(e => e.remove());

            if (data.html) {
                document.getElementById('load-more-container').insertAdjacentHTML('beforebegin', data.html);
            } else {
                loadMoreBtn.disabled = true;
                loadMoreBtn.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>No More Posts</span>
                `;
            }
        };

        const showLoadingSpinner = () => {
            document.getElementById('load-more-container').insertAdjacentHTML('beforebegin', `
                <div class="spinner-load flex justify-center items-center py-4">
                    <div class="animate-spin rounded-full h-6 w-6 border-t-2 border-b-2 border-green-500"></div>
                </div>
            `);
        };

        loadMoreBtn.addEventListener('click', () => {
            showLoadingSpinner();
            loadMoreBtn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-gray-500 animate-spin" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                <span>Loading...</span>
            `;

            let url = `/posts/load-more/${offset}`;
            fetchPosts(url, updatePosts);
            offset += 2;
        });

        // Initialize scrollable container
        document.addEventListener('DOMContentLoaded', function() {
            const postsContainer = document.getElementById('posts-container');

            // Custom scrollbar styling
            postsContainer.style.scrollbarWidth = 'thin';
            postsContainer.style.scrollbarColor = '#22c55e #f9fafb';

            // For webkit browsers
            const style = document.createElement('style');
            style.textContent = `
                #posts-container::-webkit-scrollbar {
                    width: 6px;
                }
                #posts-container::-webkit-scrollbar-track {
                    background: #f9fafb;
                }
                #posts-container::-webkit-scrollbar-thumb {
                    background-color: #22c55e;
                    border-radius: 20px;
                }
            `;
            document.head.appendChild(style);
        });
    </script>
@endsection
