@extends('layouts.app')

@section('login')
    <div class="container">
        <h3 class="text-center"><span class="glyphicon glyphicon-book"></span> 高校教材征订系统</h3>
        <div id="login">
            <form>
                <div class="form-group">
                    <label for="account"><span class="glyphicon glyphicon-user"></span>账号</label>
                    <input type="email" class="form-control" id="account" placeholder="学号/教工号">
                </div>
                <div class="form-group">
                    <label for="password"><span class="glyphicon glyphicon-lock"></span>密码</label>
                    <input type="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="password"><span class="glyphicon glyphicon-exclamation-sign"></span>验证码</label>
                    <input type="password" class="form-control" id="password">
                </div>
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
                <button type="submit" class="btn btn-primary btn-block center-block">登录</button>
            </form>
        </div>
    </div>
@endsection