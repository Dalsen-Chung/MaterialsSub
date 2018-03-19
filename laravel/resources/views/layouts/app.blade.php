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
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <style type="text/css">
        html,body{
            margin:0;
            padding:0;
            height:100%
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
        .jumbotron a{
            padding: 10px 50px !important;
        }
        .navbar-inverse {
            background-color: #093b65;
            border-color: #093b65;
        }
        #footer{
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 235px;
            background-color: #EEEEEE;
        }
        #footer .content{
            padding-top: 25px !important;
        }
        #footer .content>div>div{
            color: #636B6F;
            margin-bottom: 20px;
        }
        #footer a{
            text-decoration: none;
        }
        .technology {
            max-width: 1200px;
            width: 100%;
            margin: 20px auto 50px;
        }
        .Itemtext{
            width: 100%;
            word-wrap: break-word;
            text-indent: 2rem;
            text-align: left;
            /*border: 1px solid #636B6F;*/
            border-radius: 5px;
            margin-top: 20px;
            line-height: 2;
            padding: 20px 20px 10px 20px;
            font-size: 14px;
        }
        .technology div img{
            border-radius: 30px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            transition: box-shadow 300ms ease-out;
        }
        .technology div img:hover{
            box-shadow: 2px 2px 2px rgba(0,0,0,0.5);
        }
        #vue,#info_tea{
            -webkit-animation-delay: 0.2s;
            -moz-animation-delay: 0.2s;
            -o-animation-delay: 0.2s;
            animation-delay: 0.2s;
        }
        #mysql,#info_adm{
            -webkit-animation-delay: 0.6s;
            -moz-animation-delay: 0.6s;
            -o-animation-delay: 0.6s;
            animation-delay: 0.6s;
        }
        #bootstrap,#info_edu{
            -webkit-animation-delay: 0.4s;
            -moz-animation-delay: 0.4s;
            -o-animation-delay: 0.4s;
            animation-delay: 0.4s;
        }
        #app{
            min-height:100%;
            height:auto !important;
            /*height:100%;*/
            position:relative;
        }
        #main{
            padding-bottom: 255px;
        }
        #login{
            border: 1px solid #C6C9CB;
            border-radius: 5px;
            box-shadow: 2px 2px 2px rgba(0,0,0,0.2);
            background-color: #EEEEEE;
        }
        #cap{
            display: block;
            margin: 10px auto;
        }
        .error{
            margin-top: 10px;
            text-align: center;
        }
        #sysIntroduce .panel-body{
            text-align: center;
        }
        #sysIntroduce .panel-footer>.list-group{
            margin: 30px;
        }
        #sysIntroduce .list-group-item{
            cursor: pointer;
        }
        @media  only screen and (max-width: 1024px){
            #login{
                width: 80%;
                padding: 20px;
                margin: 30px auto;
            }
            .technology>div{
                text-align: center;
                margin-bottom: 6vh;
                padding: 2vh;
            }
            .Itemtext button{
                margin-top: 10px;
                box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            }
            .btn-laravel{
                background-color: #FB503B;
                color: #FFFFFF;
            }
            .btn-vue{
                background-color: #69B382;
                color: #FFFFFF;
            }
            .btn-boot{
                background-color: #563E7C;
                color: #FFFFFF;
            }
            .btn-mysql{
                background-color: #5287A4;
                color: #FFFFFF;
            }
            #sysIntroduce .panel{
                width: 80%;
                margin: 40px auto;
            }
        }
        @media  only screen and (min-width: 1024px){
            #login{
                width: 50%;
                padding: 50px;
                margin: 50px auto;
            }
            .radio{
                display: inline-block;
                margin-right: 30px;
            }
            .radio-group{
                text-align: center;
            }
            .technology>div{
                position: relative;
                padding-left: 1.25rem;
                padding-right: 1.25rem;
                float: left;
                width: 25%;
                text-align: center;
                margin-top: 30px;
            }
            .Itemtext button{
                margin-top: 10px;
                box-shadow: 0 2px 6px rgba(0,0,0,0.2);
                transition: background-color 300ms ease-out;
            }
            .btn-laravel:hover{
                background-color: #FB503B;
                color: #FFFFFF;
            }
            .btn-vue:hover{
                background-color: #69B382;
                color: #FFFFFF;
            }
            .btn-boot:hover{
                background-color: #563E7C;
                color: #FFFFFF;
            }
            .btn-mysql:hover{
                background-color: #5287A4;
                color: #FFFFFF;
            }
            #sysIntroduce .panel{
                width: 60%;
                margin: 40px auto;
            }
        }
    </style>
    @yield('styles')
</head>
<body ondragstart="return false">
    <div id="app">
        @include('particals.navbar')
        @yield('jumbotron')
        <div id="main">
            @yield('technology-content')
            @yield('systemTeach-content')
            @yield('login')
        </div>
        @include('particals.footer')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>