<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IC Book | @yield('title')</title>
    <link rel="icon" href="img/icons8-book-16.png" type="image/x-icon">

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
