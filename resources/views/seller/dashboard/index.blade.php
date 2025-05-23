{{-- {{ dd( $electronicBooks[1]->reviews->count()  ) }} --}}
{{-- {{ dd( $electronicBooks[0]->reviews->avg('rating') ) }} --}}



@extends('layouts.seller')

@section('title', 'Book')

@section('content')



    <div class="flex h-screen">
        <div class="w-64 bg-green-800 text-white p-4">
            <a href="{{ route('buyer.home') }}" class="flex items-center gap-3 mb-8">
                <i class="fas fa-book-open text-2xl"></i>
                <h1 class="text-xl font-bold">IC Book</h1>
            </a>

            <nav class="space-y-2">
                <a href="{{ route('seller.dashboard') }}" class="flex items-center gap-3 p-3 rounded-lg bg-green-700">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('seller.books.index') }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700">
                    <i class="fas fa-file-pdf"></i>
                    <span>Digital Books</span>
                </a>
                <a href="{{ route('seller.marketplace.books.index') }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700">
                    <i class="fas fa-book"></i>
                    <span>Physical Books</span>
                </a>
                <a href="/seller/orders" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Orders</span>
                </a>
            </nav>
        </div>

        <div class="flex-1 overflow-y-auto p-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-green-800">Seller Dashboard</h2>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <i class="fas fa-bell text-gray-600 text-xl"></i>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('buyer.profile.show', auth()->user()->id) }}" class="flex items-center gap-2">
                            <img src="{{ asset('storage/' . optional(auth()->user())->photo) }}" alt="Admin"
                                class="w-8 h-8 rounded-full">
                            <span class="font-medium">{{ auth()->user()->first_name }}</span>
                        </a>
                    </div>
                </div>
            </div>


            {{-- content here --}}
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-gray-500">Physical Books</p>
                            <p class="text-2xl font-bold">{{ $totalPhysicalBooks ?? 0 }}</p>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-book text-blue-600"></i>
                        </div>
                    </div>
                    <p class="text-sm text-blue-600 mt-2"><i class="fas fa-arrow-up"></i> 5% from last month</p>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-gray-500">Digital Books</p>
                            <p class="text-2xl font-bold">{{ $totalDigitalBooks ?? 0 }}</p>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center">
                            <i class="fas fa-file-pdf text-purple-600"></i>
                        </div>
                    </div>
                    <p class="text-sm text-purple-600 mt-2"><i class="fas fa-arrow-up"></i> 24% from last month</p>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-gray-500">Total Orders</p>
                            <p class="text-2xl font-bold">{{ $totalOrders ?? 0 }}</p>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center">
                            <i class="fas fa-shopping-cart text-yellow-600"></i>
                        </div>
                    </div>
                    <p class="text-sm text-yellow-600 mt-2"><i class="fas fa-arrow-up"></i> 8% from last month</p>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-gray-500">Total Revenue</p>
                            <p class="text-2xl font-bold">${{ number_format($totalRevenue ?? 0, 2) }}</p>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                            <i class="fas fa-dollar-sign text-green-600"></i>
                        </div>
                    </div>
                    <p class="text-sm text-green-600 mt-2"><i class="fas fa-arrow-up"></i> 10% from last month</p>
                </div>
            </div>


            {{-- other content here --}}




        </div>
    </div>


@endsection
