@extends('layouts.main')

@section('title', 'Checkout')

@section('content')
    <section class="bg-gray-100 py-10 px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Checkout Header -->
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-gray-800">Complete Your Purchase</h2>
                <p class="text-gray-600 mt-2">Please fill in your details to complete the payment.</p>
            </div>

            <!-- Checkout Form -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <form>
                    <!-- Personal Information -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Personal Information</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="firstName" class="block text-gray-700 font-medium mb-2">First Name</label>
                                <input type="text" id="firstName"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                    placeholder="John">
                            </div>
                            <div>
                                <label for="lastName" class="block text-gray-700 font-medium mb-2">Last Name</label>
                                <input type="text" id="lastName"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                    placeholder="Doe">
                            </div>
                            <div class="sm:col-span-2">
                                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                                <input type="email" id="email"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                    placeholder="john.doe@example.com">
                            </div>
                        </div>
                    </div>

                    <!-- Payment Information -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Payment Information</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="sm:col-span-2">
                                <label for="cardNumber" class="block text-gray-700 font-medium mb-2">Card Number</label>
                                <input type="text" id="cardNumber"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                    placeholder="1234 5678 9012 3456">
                            </div>
                            <div>
                                <label for="expiryDate" class="block text-gray-700 font-medium mb-2">Expiry Date</label>
                                <input type="text" id="expiryDate"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                    placeholder="MM/YY">
                            </div>
                            <div>
                                <label for="cvv" class="block text-gray-700 font-medium mb-2">CVV</label>
                                <input type="text" id="cvv"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                    placeholder="123">
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">Order Summary</h3>
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <div class="flex justify-between items-center mb-4">
                                <p class="text-gray-700">Book Title</p>
                                <p class="text-gray-800 font-semibold">$29.99</p>
                            </div>
                            <div class="flex justify-between items-center">
                                <p class="text-gray-700">Tax</p>
                                <p class="text-gray-800 font-semibold">$2.99</p>
                            </div>
                            <div class="border-t border-gray-200 pt-4 mt-4">
                                <div class="flex justify-between items-center">
                                    <p class="text-gray-800 font-bold">Total</p>
                                    <p class="text-gray-800 font-bold">$32.98</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit"
                            class="bg-green-600 text-white py-2 px-6 rounded-full text-sm font-semibold hover:bg-green-700 transition-colors duration-200">
                            Pay Now
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
