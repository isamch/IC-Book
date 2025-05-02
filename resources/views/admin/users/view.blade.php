@extends('layouts.seller')

@section('title', 'User Details')

@section('content')



    <div class="flex h-screen">
        <div class="w-64 bg-green-800 text-white p-4">
            <a  href="{{ route('buyer.home') }}"
                class="flex items-center gap-3 mb-8">
                <i class="fas fa-book-open text-2xl"></i>
                <h1 class="text-xl font-bold">IC Book</h1>
            </a>


            <nav class="space-y-2">
                <a href="/admin/dashboard" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 p-3 rounded-lg bg-green-700">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>

                <a href="{{ route('admin.books.index') }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700">
                    <i class="fas fa-file-pdf"></i>
                    <span>Digital Books</span>
                </a>

                <a href="{{ route('admin.marketplace.books.index') }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700">
                    <i class="fas fa-book"></i>
                    <span>Physical Books</span>
                </a>

                <a href="/admin/orders" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Orders</span>
                </a>
            </nav>
        </div>


        <div class="flex-1 overflow-y-auto p-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-green-800">Admin Dashboard</h2>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <i class="fas fa-bell text-gray-600 text-xl"></i>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('buyer.profile.show', auth()->user()->id) }}" class="flex items-center gap-2">
                            <img src="{{ asset('storage/' . optional(auth()->user())->photo) }}" alt="Admin" class="w-8 h-8 rounded-full">
                            <span class="font-medium">{{ auth()->user()->first_name }}</span>
                        </a>
                    </div>
                </div>
            </div>




            <div class="rounded-xl p-6">

                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-green-800 px-6 py-4">
                        <h1 class="text-2xl font-semibold text-white">User Details</h1>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                            <div class="col-span-1 flex justify-center">
                                <img src="{{ asset('storage/' . $user->photo) }}" alt="User photo"
                                    class="w-full max-w-xs h-auto object-cover rounded-lg shadow-md">
                            </div>

                            <div class="col-span-1 md:col-span-2">
                                <div class="space-y-6">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">First Name</p>
                                            <p class="mt-1 text-lg text-gray-900">
                                                {{ $user->first_name }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Last Name</p>
                                            <p class="mt-1 text-lg text-gray-900">
                                                {{ $user->last_name }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Email</p>
                                            <p class="mt-1 text-lg text-gray-900">
                                                {{ $user->email }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Age</p>
                                            <p class="mt-1 text-lg text-gray-900">
                                                {{ $user->age }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Role</p>
                                            <p class="mt-1 text-lg text-gray-900">
                                                <span
                                                    class="px-2 py-1 rounded-full text-xs
                                                @if ($user->roles[0]->name === 'admin') bg-green-100 text-green-800
                                                @elseif ($user->roles[0]->name === 'seller')
                                                    bg-blue-100 text-blue-800
                                                @elseif ($user->roles[0]->name === 'buyer')
                                                    bg-yellow-100 text-yellow-800
                                                @else
                                                    bg-gray-100 text-gray-800
                                                @endif">
                                                    {{ ucfirst($user->roles[0]->name) }}
                                                </span>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Joined Date</p>
                                            <p class="mt-1 text-lg text-gray-900">
                                                {{ $user->created_at->format('d M Y') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Email Verification</p>
                                        <p class="mt-1 text-lg text-gray-900">
                                            @if ($user->email_verified_at)
                                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">
                                                    Verified on {{ $user->email_verified_at->format('d M Y') }}
                                                </span>
                                            @else
                                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">
                                                    Not verified
                                                </span>
                                            @endif
                                        </p>
                                    </div>

                                    <div class="border-t border-gray-200 pt-6">
                                        <p class="text-sm font-medium text-gray-500">Account Status</p>
                                        <div class="mt-4 flex items-center">
                                            <div
                                                class="w-12 h-12 rounded-full border-2
                                                @if ($user->status) border-green-200 bg-green-100 @else border-gray-200 bg-gray-100 @endif
                                                flex items-center justify-center">
                                                <i class="fas fa-user text-lg
                                                    @if ($user->status) text-green-600 @else text-gray-400 @endif">
                                                </i>

                                            </div>
                                            <div class="ml-4">
                                                <p class="text-lg font-medium text-gray-900">
                                                    @if ($user->status)
                                                        Active Account
                                                    @else
                                                        Inactive Account
                                                    @endif
                                                </p>
                                                <p class="text-sm text-gray-500">
                                                    Last updated: {{ $user->updated_at->format('d M Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-between items-center">
                        <a href="{{ route('admin.users.index') }}"
                            class="px-6 py-2 border border-gray-300 rounded-lg text-base font-medium text-gray-700 hover:bg-gray-100 focus:outline-none flex items-center">
                            Back to List
                        </a>

                        <div class="flex space-x-4">
                            <a href="{{ route('buyer.chat.conversation', $user->id) }}"
                                class="px-6 py-2 border border-gray-300 rounded-lg text-base font-medium text-blue-600 hover:bg-blue-100 focus:outline-none flex items-center">
                                <i class="fas fa-envelope mr-2"></i>
                                Send Message
                            </a>

                            <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="px-6 py-2 border border-gray-300 rounded-lg text-base font-medium text-green-600 hover:bg-green-100 focus:outline-none flex items-center">
                                    <i class="fas text-2xl {{ $user->status ? 'fa-toggle-on' : 'fa-toggle-off' }} mr-2"></i>
                                    Status
                                </button>
                            </form>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>


@endsection
