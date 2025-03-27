{{-- {{ dd($user) }} --}}



@extends('layouts.main')

@section('title', 'Profile ' . $user->first_name)

@section('content')

    <section class="flex justify-center items-center min-h-screen">
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-4xl w-full p-8 transition-all duration-300 animate-fade-in">
            <div class="flex flex-col md:flex-row">
                <!-- Left Column - Profile Picture and Basic Info -->
                <div class="md:w-1/3 text-center mb-8 md:mb-0">
                    <img src="{{ asset('storage/' . $user->photo) }}" alt="Profile Picture"
                        class="rounded-full w-48 h-48 mx-auto mb-4 border-4 border-green-800 dark:border-green-900 transition-transform duration-300 hover:scale-105 object-cover">
                    <h1 class="text-2xl font-bold text-green-800 dark:text-white mb-2">
                        {{ $user->first_name }} {{ $user->last_name }}
                    </h1>

                    @if ($user->roles->count() > 0)
                        <div class="flex flex-wrap justify-center gap-2 mb-4">
                            @foreach ($user->roles as $role)
                                <span
                                    class="px-3 py-2 rounded-full text-sm font-semibold
                                    @if ($role->name === 'admin') bg-green-200 text-green-900
                                    @elseif ($role->name === 'seller') bg-blue-200 text-blue-900
                                    @elseif ($role->name === 'buyer') bg-yellow-200 text-green-900
                                    @else bg-gray-200 text-gray-900 @endif">
                                    {{ ucfirst($role->name) }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    <div class="flex flex-col space-y-4 m-4">
                        @if (auth()->id() === $user->id)
                            <a href="{{ route('seller.profile.edit', auth()->id()) }}"
                                class="bg-green-800 text-white px-4 py-2 rounded-lg hover:bg-green-900 transition-colors duration-300">
                                <i class="fas fa-edit mr-2"></i>
                                Edit Profile
                            </a>
                        @endif

                        <a href="#"
                            class="border border-gray-300 px-4 py-2 rounded-lg text-base font-medium text-green-800 hover:bg-green-100 focus:outline-none flex items-center justify-center">
                            <i class="fas fa-envelope mr-2"></i>
                            Send Message
                        </a>
                    </div>

                </div>


                <!-- Right Column - Detailed Information -->
                <div class="md:w-2/3 md:pl-8">
                    <!-- About Section -->
                    <h2 class="text-xl font-semibold text-green-800 dark:text-white mb-4">About Me</h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-6">
                        @if ($user->about_me)
                            {{ $user->about_me }}
                        @else
                            This user hasn't written a bio yet.
                        @endif
                    </p>

                    <!-- Joined Date -->
                    <h2 class="text-xl font-semibold text-green-800 dark:text-white mb-4">Member Since</h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-6">
                        <span class="text-gray-700 dark:text-gray-300">
                            {{ $user->created_at->format('F Y') }}
                        </span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            ({{ $user->created_at->diffForHumans() }})
                        </span>
                    </p>

                    <!-- Contact Information -->
                    <h2 class="text-xl font-semibold text-green-800 dark:text-white mb-4">Contact Information</h2>
                    <ul class="space-y-2 text-gray-700 dark:text-gray-300">
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-800 dark:text-green-900"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                            {{ $user->email }}
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-800 dark:text-green-900"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                            </svg>
                            {{ $user->phone ? $user->phone : '+xxx-xxx-xxx' }}
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-800 dark:text-green-900"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $user->address ? $user->address : 'xxx-xxx-xxx-xxx' }}

                        </li>
                    </ul>

                    <!-- Additional Profile Information -->
                    @if ($user->birthdate)
                        <div class="mt-6">
                            <h2 class="text-xl font-semibold text-green-800 dark:text-white mb-4">Additional Information
                            </h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @if ($user->birthdate)
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Birthdate</p>
                                        <p class="text-gray-700 dark:text-gray-300">
                                            {{ \Carbon\Carbon::parse($user->birthdate)->format('F j, Y') }}
                                        </p>
                                    </div>
                                @endif

                                @if ($user->gender)
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Gender</p>
                                        <p class="text-gray-700 dark:text-gray-300">
                                            @if ($user->gender === 'm')
                                                Male
                                            @elseif ($user->gender === 'f')
                                                Female
                                            @endif
                                        </p>
                                    </div>
                                @endif

                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>




@endsection
