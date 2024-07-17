<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Scripts -->
    <link rel="stylesheet" href="{{asset('style.css')}}"/>
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}}" />
</head>
<body>
            @yield('content')
</body>
</html>
