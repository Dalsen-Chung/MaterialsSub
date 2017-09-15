<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2017/9/12
 * Time: 17:32
 */

namespace App\Http\Controllers;

use App\Dean;
use App\Teacher;
use Illuminate\Http\Request;
use App\Student;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    private $role;
    private $roleModel;
    private $userData;
    private $accArray = [];
    private $passArray = [];

    public function login(){
        return view('login')->with(['loginErr' => '']);
    }

    public function dologin(Request $request){
        $acc = $request->input('account');
        $pass = $request->input('password');
        $user_verify = $request->input('captcha');
        $sys_verify = session('captcha');
        $this->role = $request->input('role');

        $this->validate($request,[
            'account' => 'required',
            'password' => 'required',
            'captcha' => 'required'
        ],[
            'account.required' => '账号不能为空值!',
            'password.required' => '密码不能为空值!',
            'captcha.required' => '验证码不能为空值!'
        ]);

        if($user_verify != $sys_verify)
            return view('login')->with(['loginErr' => '验证码错误']);

        switch ($this->role){
            case 'Student':
                $this->roleModel = new Student();
                $arr = $this->roleModel->where('StuAccount',$acc)->first();
                if($arr != null){
                    $SysPass = $arr->StuPassword;
                    if ($pass == $SysPass){
                            Session::put('username',$arr->StuName.',同学欢迎您');
                        return view('System.home');
                    }else{
                        return view('login',['loginErr'=>'密码错误']);
                    }
                }else{
                    return view('login',['loginErr'=>'账号不存在']);
                }
                break;
            case 'Teacher':
                $this->roleModel = new Teacher();
                $arr = $this->roleModel->where('TeaAccount',$acc)->first();
                if($arr != null){
                    $SysPass = $arr->TeaPassword;
                    if ($pass == $SysPass){
                        Session::put('username',$arr->TeaName.',老师欢迎您');
                        return view('System.home');
                    }else{
                        return view('login',['loginErr'=>'密码错误']);
                    }
                }else{
                    return view('login',['loginErr'=>'账号不存在']);
                }
                break;
            case 'Dean':
                $this->roleModel = new Dean();
                $arr = $this->roleModel->where('EduMAccount',$acc)->first();
                if($arr != null){
                    $SysPass = $arr->EduMPassword;
                    if ($pass == $SysPass){
                        Session::put('username',$arr->EduMName.'老师欢迎您');
                        return view('System.home');
                    }else{
                        return view('login',['loginErr'=>'密码错误']);
                    }
                }else{
                    return view('login',['loginErr'=>'账号不存在']);
                }
                break;
        }
        return view('home');
    }

    public function add(){
        $student = new Student();
        $data = $student::all();
        foreach ($data as $stu){
            echo $stu->StuName;
        }
    }
}