@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Login to Your Account</h2>
                <form action="{{ route('login') }}" method="POST">
                    @csrf

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

                    <div class="mb-6 flex items-center justify-between">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}
                                class="form-checkbox h-5 w-5 text-green-500">
                            <span class="ml-2 text-gray-700">Remember Me</span>
                        </label>

                        <a href="#" class="text-green-500 hover:underline">
                            Forgot Password?
                        </a>
                    </div>

                    <button type="submit"
                        class="w-full px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-300">
                        Login
                    </button>

                    <p class="mt-4 text-center text-gray-600">
                        Don't have an account? <a href="{{ route('register.form') }}"
                            class="text-green-500 hover:underline">Register here</a>.
                    </p>
                </form>
            </div>
        </div>
    </section>
@endsection
