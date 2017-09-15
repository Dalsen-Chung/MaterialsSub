<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2017/9/12
 * Time: 17:32
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }

    public function dologin(Request $request){
        $acc = $request->input('account');
        $pass = $request->input('password');
        $user_verify = $request->input('captcha');
        $sys_verify = session('captcha');
        $role = $request->input('role');

        $this->validate($request,[
            'account' => 'required',
            'password' => 'required',
            'captcha' => 'required'
        ],[
            'account.required' => '账号不能为空值!',
            'password.required' => '密码不能为空值!',
            'captcha.required' => '验证码不能为空值!'
        ]);
        echo 'acc:'.$acc.',pass:'.$pass.'<br>';
        echo 'user_verify:'.$user_verify.'<br>';
        echo 'sys_verify:'.$sys_verify.'<br>';
        echo 'role:'.$role;
    }
}