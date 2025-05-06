@extends('layouts.main')

@section('title', 'Edit Profile - ' . $user->first_name)

@section('content')
    <section class="flex justify-center items-center min-h-screen">
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-4xl w-full p-8 transition-all duration-300 animate-fade-in">


            <form method="POST" action="{{ route('buyer.profile.update', $user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/3 text-center mb-8 md:mb-0">
                        <div class="relative mx-auto w-48 h-48 mb-4">
                            <img id="profileImagePreview" src="{{ asset('storage/' . optional($user)->photo) }}" alt="Profile Picture"
                                class="rounded-full w-full h-full border-4 border-green-800 dark:border-green-900 object-cover">
                            <label for="photo"
                                class="absolute bottom-2 right-2 bg-green-800 text-white p-2 rounded-full cursor-pointer hover:bg-green-900 transition-colors">
                                <i class="fas fa-camera"></i>
                                <input type="file" id="photo" name="photo" class="hidden" accept="image/*">
                            </label>
                        </div>

                        <div class="mb-4">
                            <label for="first_name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">First Name</label>
                            <input type="text" id="first_name" name="first_name"
                                value="{{ old('first_name', $user->first_name) }}"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 @error('first_name') border-red-500 @enderror">
                            @error('first_name')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="last_name"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Last Name</label>
                            <input type="text" id="last_name" name="last_name"
                                value="{{ old('last_name', $user->last_name) }}"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 @error('last_name') border-red-500 @enderror">
                            @error('last_name')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="gender"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Gender</label>
                            <select id="gender" name="gender"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 @error('gender') border-red-500 @enderror">
                                <option value="m" {{ old('gender', $user->gender) == 'm' ? 'selected' : '' }}>Male
                                </option>
                                <option value="f" {{ old('gender', $user->gender) == 'f' ? 'selected' : '' }}>Female
                                </option>
                            </select>
                            @error('gender')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="md:w-2/3 md:pl-8">
                        <div class="mb-6">
                            <label for="about_me"
                                class="block text-xl font-semibold text-green-800 dark:text-white mb-2">About Me</label>
                            <textarea id="about_me" name="about_me" rows="4"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 @error('about_me') border-red-500 @enderror">{{ old('about_me', $user->about_me) }}</textarea>
                            @error('about_me')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <h2 class="text-xl font-semibold text-green-800 dark:text-white mb-4">Contact Information</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="email"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                                <input type="email" id="email" name="email"
                                    value="{{ old('email', $user->email) }}"
                                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 @error('email') border-red-500 @enderror">
                                @error('email')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="phone"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone</label>
                                <input type="tel" id="phone" name="phone"
                                    value="{{ old('phone', $user->phone) }}"
                                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 @error('phone') border-red-500 @enderror">
                                @error('phone')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="sm:col-span-2">
                                <label for="address"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Address</label>
                                <input type="text" id="address" name="address"
                                    value="{{ old('address', $user->address) }}"
                                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 @error('address') border-red-500 @enderror">
                                @error('address')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4 mt-8">
                            <a href="{{ route('buyer.profile.show', $user->id) }}"
                                class="px-6 py-2 border border-gray-300 rounded-lg text-base font-medium text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none">
                                Cancel
                            </a>

                            <button type="submit"
                                class="px-6 py-2 bg-green-800 text-white rounded-lg hover:bg-green-900 transition-colors duration-300">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </section>

    <script>
        document.getElementById('photo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('profileImagePreview').src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
