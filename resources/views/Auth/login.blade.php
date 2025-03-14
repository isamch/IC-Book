@extends('layouts.auth')

@section('title', 'Login')

@section('content')


    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Login to Your Account</h2>

                @if ($errors->has('email_not_verified'))
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 p-4 rounded-lg mb-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.742-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-lg font-semibold text-yellow-800">Email Verification Required</h3>
                                <p class="mt-2 text-sm text-yellow-700">
                                    {{ $errors->first('email_not_verified') }}
                                </p>
                                <form method="POST" action="{{ route('verification.send') }}" class="mt-2">
                                    @csrf
                                    <button type="submit"
                                        class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition duration-300">
                                        Resend Verification Email
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

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
