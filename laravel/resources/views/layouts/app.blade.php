<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- CSRF Token 验证用户与发起请求者是否为同一用户 --}}
    <title>Materials</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style type="text/css">
        .navbar-brand{
            padding: 0;
        }
        .navbar-brand .logo{
            display: inline-block;
            height: 60px;
            padding: 8px 20px;
        }
        .navbar{
            border-radius: 0;
            margin-bottom: 0;
            min-height:60px;
        }
        .navbar-header{
            min-height:60px;
        }
        .navbar-nav>li>a{
            padding-top: 20px;
        }
        .navbar-nav>li>.dropdown-menu{
            margin-top: 5px;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div id="app">
        @include('particals.navbar')
        <div class="main">
            @yield('content')
        </div>
        @include('particals.footer')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>