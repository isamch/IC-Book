@extends('layouts.auth')

@section('content')
    <div class="min-h-screen bg-gray-100 flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
            <div class="bg-yellow-100 border-l-4 border-yellow-500 p-4 rounded-lg">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <!-- Warning Icon -->
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
                            It seems that you have not verified your email address yet. Please check your inbox for the
                            verification link.
                        </p>
                        <p class="mt-2 text-sm text-yellow-700">
                            If you haven't received the email, <a href="#"
                                class="font-medium text-yellow-700 underline hover:text-yellow-600">click here to request
                                another verification link</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
