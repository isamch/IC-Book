{{-- {{ dd($posts) }} --}}

@extends('layouts.main')

@section('title', 'Posts')

@section('content')
    <div class="min-h-screen bg-gray-100 py-10 px-4 h-100">

        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold text-green-800 mb-8">Posts</h1>

            <div class="p-2 rounded-md shadow-inner">

                {{-- post poste --}}

                <div class="bg-white rounded-xl shadow-lg p-4 mb-6">

                    <form action="{{ route('buyer.posts.store') }}" method="POST" enctype="multipart/form-data"
                        class="flex items-center gap-4" style="align-items: start;">

                        @csrf

                        <div class="flex items-start gap-3 w-full">
                            <img src="{{ asset('storage/' . optional(Auth::user())->photo) }}" alt="User Image"
                                class="w-10 h-10 rounded-full border-2 border-green-200">

                            <div class="flex-1">
                                <input type="text" id="text-post" name="content" required
                                    placeholder="What's on your mind {{ optional(Auth::user())->first_name }}?"
                                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500
                                    @error('content') border-red-500 focus:ring-red-500 @enderror">

                                @error('content')
                                    <span class="block mt-1 text-red-500 text-sm">{{ $message }}</span>
                                @enderror

                                <input type="file" name="photo" class="hidden" id="attachment" accept="image/*"
                                    onchange="previewImage(event)">

                                @error('photo')
                                    <span class="block mt-1 text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <label for="attachment"
                            class="px-4 py-2 bg-gray-200 text-gray-600 rounded-lg font-semibold cursor-pointer hover:bg-gray-300 transition-colors duration-200 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4 3a1 1 0 011 1v10a3 3 0 006 0V7a1 1 0 112 0v7a5 5 0 01-10 0V4a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </label>

                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition-colors duration-200">
                            Post
                        </button>


                        <button onclick="clearAttachment()" id="clear-attach"
                            class="hidden px-4 py-2 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition-colors duration-200">
                            Clear
                        </button>

                    </form>


                    <div id="image-preview" class="mt-4 max-w-full rounded-lg shadow-lg overflow-hidden"></div>
                </div>

                <hr class="my-6 border-t-2 border-gray-200">


                <div id="posts-container" class="space-y-6 overflow-y-auto rounded-md"
                    style="height: 90vh; scrollbar-width: none; scrollbar-color: #48bb78 #f7fafc; ">

                    @foreach ($posts as $post)
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <div class="flex items-center gap-4 mb-4">
                                <img src="{{ asset('storage/' . optional($post->user)->photo) }}" alt="User Image"
                                    class="w-10 h-10 rounded-full border-2 border-green-200">
                                <div>
                                    <p class="font-semibold text-green-800">
                                        {{ optional($post->user)->first_name }}
                                        {{ optional($post->user)->last_name }}
                                    </p>
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
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
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
                                            <img src="{{ asset('storage/' . optional($comment->user)->photo) }}"
                                                alt="User Image" class="w-8 h-8 rounded-full border-2 border-green-200">
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
                                    <input id="comment-content-{{ $post->id }}" required type="text"
                                        placeholder="Add a comment..."
                                        class="flex-1 p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-500">
                                    <button onclick="addComment({{ $post->id }})"
                                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform rotate-180"
                                            viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M2 12l18-8-5 8 5 8-18-8z" />
                                        </svg>
                                        {{-- Post Comment --}}
                                    </button>

                                </div>
                            </div>
                        </div>
                    @endforeach



                    <!-- Show More Button -->
                    <div id="load-more-container" class="text-center pt-8">

                        <button id="load-more-posts"
                            class="inline-flex items-center bg-transparent text-gray-600 border border-gray-600 py-2 px-6 rounded-full text-sm font-medium hover:bg-gray-100 hover:text-gray-700 transition-colors duration-200">
                            Show More Products
                        </button>
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
                    `<img src="${reader.result}" alt="Selected Image" class="w-full h-auto max-h-96 object-cover rounded-lg">`;
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
    </script>



    {{-- for like post --}}
    <script>
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

                    } else {
                        likeButton.classList.remove('text-green-600');

                    }

                    likeCount.textContent = `${data.count} Likes`;

                })
                .catch(error => console.error('Error:', error));

        }
    </script>



    {{-- for add comments --}}
    <script>
        function createCommentHTML(photo, firstName, content) {
            return `
                <div class="flex items-start gap-3 mb-4">
                    <img src="/storage/${photo}" alt="User Image" class="w-8 h-8 rounded-full border-2 border-green-200">
                    <div class="flex-1">
                        <div class="flex items-center mb-2 gap-2">
                            <p class="text-sm font-semibold text-green-800">${firstName}</p>
                            <p class="text-xs text-gray-500 leading-tight">
                                (1 second ago)
                            </p>
                        </div>
                        <p class="text-sm text-gray-700">
                            ${content}
                        </p>
                    </div>
                </div>

                <div class="border-t border-gray-300 my-2 opacity-30"></div>


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

                    console.log(data.comment);

                    const commentsContainer = document.getElementById(`comments-container-${postId}`);
                    if (commentsContainer) {
                        const newCommentHTML = createCommentHTML(data.user.photo, data.user.first_name, data.comment
                            .content);
                        commentsContainer.insertAdjacentHTML('afterbegin', newCommentHTML);
                    }

                    const commentInput = document.getElementById(`comment-content-${postId}`);
                    if (commentInput) {
                        commentInput.value = '';
                    }

                })
                .catch(error => console.error('Error adding comment:', error));
        };
    </script>




    <script>
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
            loadMoreBtn.textContent = "Load More...";

            containerPosts.querySelectorAll('.spiner-load').forEach(e => e.remove());



            if (data.html) {
                document.getElementById('load-more-container').insertAdjacentHTML('beforebegin', data.html);
                // containerPosts.innerHTML += data.html;
            } else {
                loadMoreBtn.disabled = true;
                loadMoreBtn.textContent = "No additional items available";
            }

        };


        const showLoadingSpinner = () => {

            document.getElementById('load-more-container').insertAdjacentHTML('beforebegin', `
                <div class="spiner-load flex justify-center items-center h-40">
                    <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-green-500"></div>
                </div>
            `);

        };



        loadMoreBtn.addEventListener('click', () => {
            showLoadingSpinner();

            let url = `/posts/load-more/${offset}`;

            fetchPosts(url, updatePosts);

            offset += 2;

        });
    </script>
@endsection
