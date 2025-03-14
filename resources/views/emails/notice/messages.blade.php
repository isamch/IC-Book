<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full text-center">

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
            @if (!session('status'))
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
</body>

</html>
