<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- CSRF Token 验证用户与发起请求者是否为同一用户 --}}
    <link rel="shortcut icon" href="{{ config('system.default_icon') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <title>{{ config('system.adminName') }}</title>
    <script src="{{ asset('js/jquery-3.2.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <style type="text/css">
        .warp{
            position: fixed;
            width: 100%;
            height: 100%;
            color: #fafafa;
        }
        .overlay{
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 1002;
        }
        .aside{
            height: 100%;
            background-color: #E15748;
            width: 250px;
            display: inline-block;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            overflow-x: hidden;
            overflow-y: auto;
            z-index: 1000;
            position: absolute;
            left: 0;
        }
        .aside h3{
            padding: 20px 0 10px;
            text-align: center;
        }
        .aside ul{
            list-style: none;
            text-align: center;
            padding: 0;
            width: 100%;
        }
        .aside ul li{
            display: inline-block;
            line-height: 20px;
            position: relative;
            width: 100%;
        }
        .aside ul li::before{
            background-color: #1E2022;
            content: '';
            height: 100%;
            left: 0;
            position: absolute;
            top: 0;
            -webkit-transition: width 0.2s ease-in;
            transition: width 0.2s ease-in;
            width: 3px;
            z-index: 0;
        }
        .aside ul li:hover::before{
            width: 100%;
        }
        .aside ul li a{
            display: block;
            padding: 15px 10px 15px 40px;
            text-align: left;
            color: #fafafa;
            outline: none;
            font-size: 16px;
            text-decoration: none;
            position: relative;
        }
        .content{
            height: 100%;
            background-color: #323639;
            width: 100%;
            display: inline-block;
            float: right;
            z-index: 1001;
            overflow-y: auto;
            position: absolute;
        }
        .overlay,.content,.aside{
            transition: all 0.4s ease;
            -moz-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            -webkit-transition: all 0.4s ease;
        }
        .contentToggle{
            margin-left: 250px;
        }
        .overlayToggle{
            left: 250px;
            display: block;
        }
        .operation button{
            border: none;
            display: inline-block;
            height: 50px;
            outline: none;
            width: 50px;
            background: transparent;
            font-size: 25px;
        }
        .close{
            color: #fafafa;
            float: left;
        }
        .exit{
            margin: 10px;
            float: right;
        }
        .exit a{
            color: #fafafa;
        }
        .operation button:hover{
            color: #fafafa;
        }
        .operation button:focus{
            color: #fafafa;
        }
        .welcome{
            text-align: center;
            margin-top: 20px;
            font-size: 15px;
        }
        .content-block{
            margin-top: 20px;
        }
    </style>
    @yield('styles')
</head>
<body>

    <div class="warp">
        <nav class="aside">
            <h3>System Menu</h3>
            <ul>
                <li><a href="{{ url('/admin/student') }}"><span class="glyphicon glyphicon-education"></span> Student</a></li>
                <li><a href="{{ url('/admin/teacher') }}"><span class="glyphicon glyphicon-user"></span> Teacher</a></li>
                <li><a href="{{ url('/admin/dean') }}"><span class="glyphicon glyphicon-paperclip"></span> Academic Dean</a></li>
                <li><a href="{{ url('/admin/book') }}"><span class="glyphicon glyphicon-book"></span> Books</a></li>
                <li><a href="{{ url('/admin/major') }}"><span class="glyphicon glyphicon-wrench"></span> Major</a></li>
                <li><a href="{{ url('/admin/bookorno') }}"><span class="glyphicon glyphicon-question-sign"></span> StuBook-orNo</a></li>
            </ul>
        </nav>
        <div class="content">
            <div class="overlay"></div>
            <div class="operation">
                <button type="button" class="close animated fadeInLeft" id="menuBtn">
                    <span class="glyphicon glyphicon-menu-hamburger"></span>
                </button>
                <button type="button" class="exit animated fadeInRight">
                    <a href="{{url('/admin/logout')}}"><span class="glyphicon glyphicon-off"></span></a>
                </button>
            </div>
            <div class="welcome">
                Welcome,{{Session::get('name')}}
            </div>
            <div class="content-block">
                @yield('student')
                @yield('teacher')
                @yield('dean')
                @yield('book')
                @yield('major')
                @yield('bookOrNo')
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#menuBtn').click(function(){
            $('.content').toggleClass('contentToggle');
            $('.overlay').toggleClass('overlayToggle');
        });
        $('.overlay').click(function(){
            $('.content').toggleClass('contentToggle');
            $('.overlay').toggleClass('overlayToggle');
        });
        $('.aside>ul>li').click(function(){
            $('.content').toggleClass('contentToggle');
            $('.overlay').toggleClass('overlayToggle');
        })
    </script>
    @yield('scripts')
</body>
</html>