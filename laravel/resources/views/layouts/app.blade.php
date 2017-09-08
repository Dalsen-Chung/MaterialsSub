<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- CSRF Token 验证用户与发起请求者是否为同一用户 --}}
    <title>{{ config('system.appName') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
        .navbar-inverse .navbar-nav>li>a{
            padding-top: 20px;
            line-height: 25px;
            color: #f3eded;

        }
        .navbar-nav>li>.dropdown-menu{
            margin-top: 1px;
        }
        .jumbotron a{
            padding: 10px 50px !important;
        }
        .navbar-inverse {
            background-color: #093b65;
            border-color: #093b65;
        }
        #footer{
            width: 100%;
            height: 200px;
            background-color: #EEEEEE;
        }
        #footer .content{
            padding-top: 25px !important;
        }
        #footer .content>div>div{
            color: #636B6F;
            margin-bottom: 20px;
        }
        .main{
            margin-top: 20px;
            margin-bottom: 50px;
        }
        .technology {
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
        }
        /*.technology::after{*/
            /*content: " ";*/
            /*display: block;*/
            /*height: 0;*/
            /*clear: both;*/
        /*}*/
        .technology div{
            position: relative;
            padding-left: 1.25rem;
            padding-right: 1.25rem;
            float: left;
            width: 25%;
            height: 500px;
            text-align: center;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div id="app">
        @include('particals.navbar')
        @include('particals.jumbotron')
        <div class="main">
            @yield('content')
        </div>
        @include('particals.footer')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>