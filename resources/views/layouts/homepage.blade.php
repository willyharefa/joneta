<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('/icon/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    @stack('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    {{-- My Style --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.24/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('/css/homepage.css') }}">
    <title>{{ $title }}</title>
</head>
<body>
    
    @include('components.navbar')
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.24/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="{{ asset('/js/homepage.js') }}"></script>
    <script src="{{ asset('/js/dashboard.js') }}"></script>
    @stack('script')
</body>
</html>