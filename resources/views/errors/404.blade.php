<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <section class="min-h-screen flex items-center justify-center py-10 px-4">
        <div class="max-w-2xl mx-auto text-center">
            <h1 class="text-9xl font-extrabold text-gray-800 mb-8 relative">
                404
                <span
                    class="absolute left-1/2 transform -translate-x-1/2 -bottom-4 w-24 h-1.5 bg-green-500 rounded-full"></span>
                <span
                    class="absolute left-1/2 transform -translate-x-1/2 -bottom-6 w-16 h-1.5 bg-green-400 rounded-full opacity-50"></span>
            </h1>

            <p class="text-2xl font-medium text-gray-700 mb-8">
                Oops! The page you're looking for doesn't exist.
            </p>

            <div class="flex space-x-4 justify-center">
                <a href="{{ url('/home') }}"
                    class="inline-flex items-center justify-center border border-green-600 text-green-600 py-3 px-8 rounded-lg text-lg font-semibold hover:bg-green-600 hover:text-white transition-colors duration-200 w-40"
                    title="Go to Home Page">
                    Home Page
                </a>
                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center justify-center bg-green-600 text-white py-3 px-8 rounded-lg text-lg font-semibold hover:bg-green-700 transition-colors duration-200 w-40">
                    Go Back
                </a>
            </div>

        </div>
    </section>
</body>

</html>
