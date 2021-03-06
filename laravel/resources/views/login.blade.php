@extends('layouts.app')

@section('login')
    <div class="container">
        <h3 class="text-center"><span class="glyphicon glyphicon-book"></span> 高校教材征订系统</h3>
        <div id="login">
            <form action="{{ url('/dologin') }}" method="post" role="form">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <div class="form-group">
                    <label for="account"><span class="glyphicon glyphicon-user"></span>账号</label>
                    <input type="text" class="form-control" id="account" name="account" placeholder="学号/教工号" value="{{ old('account') }}">
                </div>
                <div class="form-group">
                    <label for="password"><span class="glyphicon glyphicon-lock"></span>密码</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="captcha"><span class="glyphicon glyphicon-exclamation-sign"></span>验证码</label>
                    <input type="text" class="form-control" id="captcha" name="captcha">
                    <img src="{{ url('/captcha/1') }}" alt="" onclick="javascript:re_captcha();" id="cap">
                </div>
                {{ session('myCaptcha') }}
                <div class="form-group radio-group">
                    <div class="radio">
                        <label>
                            <input type="radio" name="role" id="role1" value="Student" checked>
                            学生登录
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="role" id="role2" value="Teacher">
                            教师登录
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="role" id="role3" value="Dean">
                            教务登录
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block center-block" onclick="loading()">登录</button>
                <div class="spinner" id="loginLoading" style="display: none;">
                    <div class="bounce1"></div>
                    <div class="bounce2"></div>
                    <div class="bounce3"></div>
                </div>
                @if(count($errors)>0)
                    <div class="error">
                        @foreach($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                @if(count($loginErr)>0)
                    <div class="error">
                        <p class="text-danger">{{$loginErr}}</p>
                    </div>
                @endif

            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function re_captcha() {
        $url = "{{ url('/captcha/') }}";
        $url = $url + "/" + Math.random();
        document.getElementById('cap').src=$url;
    }

    function loading(){
        $('#loginLoading').show();
    }
</script>
@endsection