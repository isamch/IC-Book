<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="user-id" content="{{ Auth::user()->id }}">

    <title>IC Book | @yield('title')</title>
    <link rel="icon" href="img/icons8-book-16.png" type="image/x-icon">

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">


        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

</head>

<body class="bg-gray-100 font-sans">
    @include('components.navbar')
    @include('components.alerts')

    <main>
        @yield('content')
    </main>

    @include('components.footer')

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
</body>

</html>
