{{-- {{ dd( $physicalBooks[1]->book->images[0]->image) }} --}}

@extends('layouts.admin')

@section('title', 'Marketplace Books Details')

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
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>

                <a href="{{ route('admin.books.index') }}"
                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700">
                    <i class="fas fa-file-pdf"></i>
                    <span>Digital Books</span>
                </a>

                <a href="{{ route('admin.marketplace.books.index') }}"
                    class="flex items-center gap-3 p-3 rounded-lg bg-green-700">
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




            <div class="bg-white rounded-xl shadow-lg p-6">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-green-800">Marketplace Books Management</h3>
                    {{-- <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Add New User</button> --}}
                </div>




                <div class="overflow-x-auto bg-white rounded-lg shadow">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Book ID</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Title</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Author</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Price</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Location</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Seller</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    View</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Active/Inactive</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">


                            @foreach ($physicalBooks as $physicalBook)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $physicalBook->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ Str::words($physicalBook->book->title, 3, '...') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $physicalBook->book->author }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">$
                                        {{ $physicalBook->book->price }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $physicalBook->location }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">

                                            <div class="flex-shrink-0 h-10 w-10">

                                                <img class="h-10 w-10 rounded-full"
                                                    src="{{ asset('storage/' . $physicalBook->book->seller->user->photo) }}"
                                                    alt="Seller">
                                            </div>


                                            <div class="ml-4">
                                                <a href="{{ route('admin.users.show', $physicalBook->book->seller->user->id) }}"
                                                    class="text-sm font-medium text-gray-900 hover:underline">
                                                    {{ $physicalBook->book->seller->user->first_name }}
                                                    {{ $physicalBook->book->seller->user->last_name }}

                                                </a>
                                                <div class="text-xs text-gray-500">
                                                    {{ $physicalBook->book->seller->user->email }}
                                                </div>
                                            </div>
                                        </div>

                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('admin.marketplace.books.show', $physicalBook->id) }}"
                                            class="text-green-600 hover:text-indigo-900">
                                            <i class="fas fa-eye mr-1"></i>
                                        </a>
                                    </td>

                                    <td class="px-8 py-4">
                                        <form action="{{ route('admin.marketplace.books.toggle-status', $physicalBook->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-green-600 hover:text-green-800">
                                                <i
                                                    class="fas text-2xl {{ $physicalBook->book->status ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
                {{-- pagination --}}
                <div class="mt-4">
                    {{ $physicalBooks->links() }}
                </div>

            </div>






        </div>
    </div>




@endsection
