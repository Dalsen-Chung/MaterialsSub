<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- CSRF Token 验证用户与发起请求者是否为同一用户 --}}
    <link rel="shortcut icon" href="{{ config('system.default_icon') }}">
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Condiment'>
    <title>{{ config('system.adminName') }}</title>
    <style type="text/css">
        body{
            background: url({{ asset('images/banner.jpg') }}) repeat;
            font-family: 'Roboto', sans-serif;
            font-size: 100%;
        }
        .absolute-center{
            margin: auto;
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }
        .loginBlock{
            width: 35%;
            height: 400px;
            font-family:  'Condiment', cursive;
        }
        .input-area{
            width: 100%;
            background-color: #E1E1E1;
            border: 1px solid #292D30;
            border-radius: 25px 25px 0 0;
            padding: 20px 60px;
            box-sizing: border-box;
            text-align: center;
        }
        .input-area input[type="text"],.input-area input[type="password"]{
            outline: none;
            font-size: 15px;
            font-weight: 500;
            color: #818181;
            padding: 15px 20px;
            background: #CACACA;
            border: 1px solid #ccc;
            border-radius: 25px;
            -webkit-border-radius: 25px;
            -moz-border-radius: 25px;
            margin: 0 0 12px 0;
            width: 88%;
            -webkit-appearance: none;
        }
        .login-area button{
            width: 100%;
            background-color: #E15748;
            border: 1px solid #292D30;
            border-radius: 0 0 25px 25px;
            padding: 20px 60px;
            box-sizing: border-box;
            cursor: pointer;
            color: #E1E1E1;
            font-size: 30px;
            font-family:  'Condiment', cursive;
            display: block;
            text-align: center;
            outline: none;
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }
        .login-area button:hover{
            color: #D33E2E;
            background-color: #24A77C;
        }
        .alert ul{
            padding: 0;
            margin: 0 auto;
            list-style: none;
            text-align: center;
            color: #E15748;
            font-family: "Times New Roman", Times, serif;
            font-size: 15px;
        }
    </style>
</head>
<body>
    <div class="loginBlock absolute-center">
        <form action="{{ url('admin/login') }}"  method="post" role="form">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <div class="input-area">
                <h1>Background System</h1>
                <input type="text"  name="Account"  placeholder="Account" >
                <input type="password" name="Password" placeholder="Password">
                @if (count($errors) > 0)
                    <div class="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="login-area">
                <button type="submit">Sign In</button>
            </div>
        </form>
    </div>
</body>
</html>