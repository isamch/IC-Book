@extends('layouts.main')

@section('title', 'Email verification')

@section('content')

    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full text-center" style="height: auto;">


            @if (session('verify_email_needed') === 'warning')
                <div class="flex items-start p-6 bg-yellow-50 border-l-4 border-yellow-400 rounded-lg shadow-sm">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.742-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>

                    <div class="ml-3">
                        <h3 class="text-lg font-semibold text-yellow-800">Email Verification Required</h3>

                        <p class="mt-2 text-sm text-yellow-700 leading-relaxed">
                            It looks like your email address is not verified yet. Please check your inbox for the
                            verification link.
                        </p>

                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center bg-yellow-500 text-white px-5 py-2 rounded-md hover:bg-yellow-600 transition duration-300 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Resend Verification Email
                            </button>
                        </form>



                    </div>

                </div>
            @endif



            <!-- Success Message -->
            @if (session('status') === 'success')
                <!-- Success Icon -->
                <div class="flex justify-center mb-4">
                    <svg class="h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <!-- Success Message -->
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">
                    {{ session('message') ?? 'Operation successful!' }}
                </h3>

                <!-- Go Home Button -->
                @if (session('action') === 'verify-done')
                    <a href="{{ url('/home') }}"
                        class="inline-block bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition duration-300">
                        Go Home
                    </a>
                @endif

                @if (session('action') === 'send-email')
                    <form method="POST" action="{{ route('verification.send') }}" class="mt-2">
                        @csrf
                        <button type="submit"
                            class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition duration-300">
                            Resend Verification Email
                        </button>
                    </form>
                @endif

            @endif

            <!-- Error Message -->
            @if (session('status') === 'error')
                <!-- Error Icon -->
                <div class="flex justify-center mb-4">
                    <svg class="h-12 w-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>

                <!-- Error Message -->
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">
                    {{ session('message') ?? 'An error occurred!' }}
                </h3>

                <!-- Go Home Button -->
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit"
                        class="inline-block bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition duration-300">
                        Logout
                    </button>
                </form>

                <form method="POST" action="{{ route('verification.send') }}" class="mt-2">
                    @csrf
                    <button type="submit"
                        class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition duration-300">
                        Resend Verification Email
                    </button>
                </form>
            @endif

            <!-- Warning Message -->
            @if (session('status') === 'warning')
                <!-- Warning Icon -->
                <div class="flex justify-center mb-4">
                    <svg class="h-12 w-12 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>

                <!-- Warning Message -->
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">
                    {{ session('message') ?? 'Warning: Something needs your attention!' }}
                </h3>

                <!-- Go Home Button -->
                <a href="{{ url('/home') }}"
                    class="inline-block bg-yellow-500 text-white px-6 py-2 rounded-lg hover:bg-yellow-600 transition duration-300">
                    Go Home
                </a>
            @endif

            <!-- Default Message (if no status is set) -->
            @if (!session('status') && !session('verify_email_needed'))
                <!-- Default Icon -->
                <div class="flex justify-center mb-4">
                    <svg class="h-12 w-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>

                <!-- Default Message -->
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">
                    {{ session('message') ?? 'No message available.' }}
                </h3>

                <!-- Go Home Button -->
                <a href="{{ url('/home') }}"
                    class="inline-block bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition duration-300">
                    Go Home
                </a>
            @endif
        </div>
    </div>

@endsection
