<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>429 - Too Many Requests</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <section class="min-h-screen flex items-center justify-center py-10 px-4">
        <div class="max-w-2xl mx-auto text-center">
            <h1 class="text-9xl font-extrabold text-gray-800 mb-8 relative">
                429
                <span
                    class="absolute left-1/2 transform -translate-x-1/2 -bottom-4 w-24 h-1.5 bg-yellow-500 rounded-full"></span>
                <span
                    class="absolute left-1/2 transform -translate-x-1/2 -bottom-6 w-16 h-1.5 bg-yellow-400 rounded-full opacity-50"></span>
            </h1>

            <p class="text-2xl font-medium text-gray-700 mb-8">
                Oops! You've sent too many requests. Please wait and try again later.
            </p>

            <div class="flex space-x-4 justify-center">
                <a href="{{ url('/home') }}"
                    class="inline-flex items-center justify-center border border-yellow-600 text-yellow-600 py-3 px-8 rounded-lg text-lg font-semibold hover:bg-yellow-600 hover:text-white transition-colors duration-200 w-52"
                    title="Return to Home Page">
                    Return to Home
                </a>
            </div>

        </div>
    </section>
</body>

</html>
