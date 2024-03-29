<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Books store') }}</title> --}}
    <title>Books store</title>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1.9.6/dayjs.min.js"></script>
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
</head>
<body class="wrapper">
    @if(Route::is('admin-*') || Route::is('dashboard'))
        <div class="dashboard-marker">
            dashboard (
                @if(Auth::user()->role_id === 2)
                    admin
                @else
                    staff
                @endif
            )
        </div>
    @endif
    @include('includes.header')
    @include('includes.main-nav')
   
    @yield('content')
    
    @include('includes.footer')
    
    <script src="{{ asset(mix('js/app.js')) }}"></script>
    @stack('js-scripts')
    @stack('vue-scripts')
</body>
</html>
