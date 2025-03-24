<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | @yield('title')</title>

    <link rel="icon" href="img/icons8-book-16.png" type="image/x-icon">

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100">

    @include('components.alerts')


    @yield('content')



    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
</body>

</html>
