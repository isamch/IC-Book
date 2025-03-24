@extends('layouts.admin')

@section('title', 'Users')

@section('content')

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-green-800 text-white p-4">
            <div class="flex items-center gap-3 mb-8">
                <i class="fas fa-book-open text-2xl"></i>
                <h1 class="text-xl font-bold">IC Book</h1>
            </div>

            <nav class="space-y-2">
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg bg-green-700">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700">
                    <i class="fas fa-book"></i>
                    <span>Physical Books</span>
                </a>
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700">
                    <i class="fas fa-file-pdf"></i>
                    <span>Digital Books</span>
                </a>
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Orders</span>
                </a>
                <a href="#" class="flex items-center gap-3 p-3 rounded-lg hover:bg-green-700">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto p-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-green-800">Admin Dashboard</h2>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <i class="fas fa-bell text-gray-600 text-xl"></i>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <img src="https://i.pravatar.cc/40" alt="Admin" class="w-8 h-8 rounded-full">
                        <span class="font-medium">Admin</span>
                    </div>
                </div>
            </div>


            {{-- content here --}}
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-gray-500">Total Users</p>
                            <p class="text-2xl font-bold">1,248</p>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                            <i class="fas fa-users text-green-600"></i>
                        </div>
                    </div>
                    <p class="text-sm text-green-600 mt-2"><i class="fas fa-arrow-up"></i> 12% from last month</p>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-gray-500">Physical Books</p>
                            <p class="text-2xl font-bold">856</p>
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
                            <p class="text-2xl font-bold">1,532</p>
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
                            <p class="text-2xl font-bold">324</p>
                        </div>
                        <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center">
                            <i class="fas fa-shopping-cart text-yellow-600"></i>
                        </div>
                    </div>
                    <p class="text-sm text-yellow-600 mt-2"><i class="fas fa-arrow-up"></i> 8% from last month</p>
                </div>
            </div>

            {{-- other content here --}}


            <!-- Users Management -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-green-800">Users Management</h3>
                    <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Add New User</button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="text-left border-b">
                                <th class="pb-3">User ID</th>
                                <th class="pb-3">Name</th>
                                <th class="pb-3">Email</th>
                                <th class="pb-3">Role</th>
                                <th class="pb-3">Joined</th>
                                <th class="pb-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach($users as $user)
                            <tr>
                                <td class="py-4">#{{ $user->id }}</td>
                                <td class="py-4 flex items-center gap-2">
                                    <img src="{{ $user->avatar_url ?? 'https://i.pravatar.cc/30?img='.$loop->index }}"
                                         alt="User" class="w-6 h-6 rounded-full">
                                    {{ $user->name }}
                                </td>
                                <td class="py-4">{{ $user->email }}</td>
                                <td class="py-4">
                                    <span class="px-2 py-1 {{ $user->role === 'admin' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }} rounded-full text-xs">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="py-4">{{ $user->created_at->format('d M Y') }}</td>
                                <td class="py-4 flex gap-2">
                                    <button class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                <!-- الترقيم -->

                <div class="mt-4">
                    {{ $users->links() }}
                </div>

{{--
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="text-left border-b">
                                <th class="pb-3">User ID</th>
                                <th class="pb-3">Name</th>
                                <th class="pb-3">Email</th>
                                <th class="pb-3">Role</th>
                                <th class="pb-3">Joined</th>
                                <th class="pb-3">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            @for($i = 1; $i < 10; $i++)
                                <tr>
                                    <td class="py-4">#-{{ $i }}</td>
                                    <td class="py-4 flex items-center gap-2">
                                        <img src="https://i.pravatar.cc/30?img=2" alt="User" class="w-6 h-6 rounded-full">
                                        Jane Smith
                                    </td>
                                    <td class="py-4">jane@example.com</td>
                                    <td class="py-4"><span
                                            class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Admin</span>
                                    </td>
                                    <td class="py-4">10 Dec 2022</td>
                                    <td class="py-4 flex gap-2">
                                        <button class="text-blue-600 hover:text-blue-800"><i class="fas fa-edit"></i></button>
                                        <button class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endfor

                        </tbody>
                    </table>
                </div>

                <div class="mt-4 flex justify-between items-center">
                    <div class="text-sm text-gray-600">
                        Showing 1 to 10 of 100 entries
                    </div>
                    <div class="flex gap-1">
                        <button class="px-3 py-1 bg-gray-200 rounded">Previous</button>
                        <button class="px-3 py-1 bg-green-500 text-white rounded">1</button>
                        <button class="px-3 py-1 bg-gray-200 rounded">2</button>
                        <button class="px-3 py-1 bg-gray-200 rounded">3</button>
                        <button class="px-3 py-1 bg-gray-200 rounded">Next</button>
                    </div>
                </div> --}}

            </div>






        </div>
    </div>






@endsection
