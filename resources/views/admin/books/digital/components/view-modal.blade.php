<!-- Book Details Modal -->
<div id="bookModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
        </div>

        <!-- Modal container -->
        <div
            class="inline-block align-bottom bg-white rounded-xl shadow-lg transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <!-- Modal header -->
            <div class="bg-green-800 px-6 py-4 rounded-t-xl">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-white" id="bookTitle">Book Details</h3>
                    <button onclick="closeModal()" class="text-white hover:text-green-200 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal content -->
            <div class="bg-white px-6 py-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Book cover -->
                    <div class="col-span-1 flex justify-center">
                        <img id="bookCover" src="" alt="Book cover"
                            class="w-48 h-64 object-cover rounded-lg shadow-md">
                    </div>

                    <!-- Book details -->
                    <div class="col-span-1 md:col-span-2">
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Author</p>
                                    <p id="bookAuthor" class="mt-1 text-sm text-gray-900"></p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Price</p>
                                    <p id="bookPrice" class="mt-1 text-sm text-gray-900"></p>
                                </div>
                            </div>


                            <div>
                                <p class="text-sm font-medium text-gray-500">Description</p>
                                <p id="bookDescription" class="mt-1 text-sm text-gray-900"></p>
                            </div>

                            <div>
                                <p class="text-sm font-medium text-gray-500">Rating</p>
                                <div class="flex justify-center items-center mt-1">
                                    <div id="ratingStars" class="flex justify-center">

                                        {{-- yellow --}}
                                        {{-- <i class="fas fa-star text-yellow-400 w-5 h-5"></i> --}}

                                        {{-- graye --}}
                                        {{-- <i class="fas fa-star text-gray-400 w-5 h-5"></i> --}}

                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 pt-4">
                                <p class="text-sm font-medium text-gray-500">Seller</p>
                                <div class="mt-2 flex  items-center">
                                    <img id="sellerImage" src="" alt="Seller"
                                        class="w-10 h-10 rounded-full border-2 border-green-200">
                                    <div class="ml-3">
                                        <p id="sellerName" class="text-sm font-medium text-gray-900"></p>
                                        <p id="sellerEmail" class="text-xs text-gray-500"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="bg-gray-50 px-6 py-4 rounded-b-xl flex justify-end space-x-3">
                <button type="button" onclick="closeModal()"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 focus:outline-none">
                    Close
                </button>
                {{-- <button type="button" id="editBookBtn"
                    class="px-4 py-2 bg-green-600 rounded-lg text-sm font-medium text-white hover:bg-green-700 focus:outline-none">
                    Edit Book
                </button> --}}
            </div>
        </div>
    </div>
</div>


