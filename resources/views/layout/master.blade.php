<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link href="/fontawesome/css/solid.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{asset('logo.ico')}}">
{{--    JANGAN LUPA BLM MASUK"IN ICON--}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="/js/app.js"></script>
    @yield('head')
    <title>@yield('title')</title>
</head>
<header>
    @if(\Illuminate\Support\Facades\Auth::check())
        @include('layout.header')
    @else
        @include('layout.guest-header')
    @endif
</header>
<body>
@yield('content')
</body>
<footer>
    @include('layout.footer')
</footer>
</html>
