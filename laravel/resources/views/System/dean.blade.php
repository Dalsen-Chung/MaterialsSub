<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- CSRF Token 验证用户与发起请求者是否为同一用户 --}}
    <link rel="shortcut icon" href="{{ config('system.default_icon') }}">
    <title>{{ config('system.appName') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<style>
    html,body{
        margin:0;
        padding:0;
        height:100%;
    }
    #app{
        min-height:100%;
        height:auto !important;
        position:relative;
    }
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
    .navbar-inverse {
        background-color: #093b65;
        border-color: #093b65;
    }
    .jumbotron{
        text-align: center;
    }
    #footer{
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 200px;
        background-color: #EEEEEE;
    }
    #footer .content{
        padding-top: 25px;
    }
    #footer .content>div>div{
        color: #636B6F;
        margin-bottom: 20px;
    }
</style>
<body>
<div id="app">
    @include('particals.navbar')
    {{--<example></example>--}}
    <Dean></Dean>
    @include('particals.footer')
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>