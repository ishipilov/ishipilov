<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('page-title', Lang::get('routes.web.' . Route::currentRouteName())) | {{ config('app.name', 'Laravel') }}
    </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}?v={{ Carbon\Carbon::now()->year . Carbon\Carbon::now()->weekOfYear }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
	@stack('head')
</head>
<body>
	@yield('template')

	@stack('script')
</body>
</html>
