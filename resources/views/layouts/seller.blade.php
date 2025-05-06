<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @auth
        <meta name="user-id" content="{{ Auth::user()->id }}">
    @endauth

    <title>Seller Dashboard | @yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('storage/images/favicon/book-favicon.png') }}" type="image/x-icon">

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-gray-100">

    @include('components.alerts')


    @yield('content')



    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
</body>

</html>
