@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Create an Account</h2>
                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-6 flex justify-center">
                        <div class="relative w-32 h-32 rounded-full overflow-hidden border-4 border-green-500">
                            <img id="profile-preview" src="https://www.pngkey.com/png/detail/115-1150152_default-profile-picture-avatar-png-green.png" alt="Profile Picture"
                                class="w-full h-full object-cover">
                            <input type="file" id="profile-image" name="photo" accept="image/*"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        </div>
                        @error('photo')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 text-center">
                        <label class="block text-gray-700 mb-2">Role</label>
                        <div class="flex justify-center space-x-6">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="radio" name="user_type" value="buyer" {{ old('user_type', 'client') == 'client' ? 'checked' : '' }}
                                    class="form-radio h-5 w-5 text-green-500">
                                <span class="ml-2 text-gray-700">Buyer</span>
                            </label>
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="radio" name="user_type" value="seller" {{ old('user_type') == 'seller' ? 'checked' : '' }}
                                    class="form-radio h-5 w-5 text-green-500">
                                <span class="ml-2 text-gray-700">Seller</span>
                            </label>
                        </div>
                        @error('user_type')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="first_name" class="block text-gray-700">First Name</label>
                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}"
                            placeholder="Enter your first name"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 @error('first_name') border-red-500 @enderror">
                        @error('first_name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="last_name" class="block text-gray-700">Last Name</label>
                        <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}"
                            placeholder="Enter your last name"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 @error('last_name') border-red-500 @enderror">
                        @error('last_name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="Enter your email"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 @error('email') border-red-500 @enderror">
                        @error('email')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-gray-700">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 @error('password') border-red-500 @enderror">
                        @error('password')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="Confirm your password"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 @error('password_confirmation') border-red-500 @enderror">
                        @error('password_confirmation')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="birthdate" class="block text-gray-700">Date of Birth</label>
                        <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate') }}"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 @error('birthdate') border-red-500 @enderror">
                        @error('birthdate')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-300">
                        Register
                    </button>

                    <p class="mt-4 text-center text-gray-600">
                        Already have an account? <a href="{ route('login.form') }}" class="text-green-500 hover:underline">Login here</a>.
                    </p>
                </form>
            </div>
        </div>
    </section>

    <script>
        const profileImageInput = document.getElementById('profile-image');
        const profilePreview = document.getElementById('profile-preview');

        const defaultImage = "https://www.pngkey.com/png/detail/115-1150152_default-profile-picture-avatar-png-green.png";
        profilePreview.setAttribute('src', defaultImage);

        profileImageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    profilePreview.setAttribute('src', e.target.result);
                };

                reader.readAsDataURL(file);
            } else {
                profilePreview.setAttribute('src', defaultImage);
            }
        });
    </script>
@endsection
