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
    private $sys_verify;

    public function login(){
        return view('login')->with(['loginErr' => '']);
    }

    public function dologin(Request $request){
        $acc = $request->input('account');
        $pass = $request->input('password');
        $user_verify = $request->input('captcha');
        $this->sys_verify = session('captcha');
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

        if($user_verify != $this->sys_verify){
            return redirect('/login')->withErrors(['loginErr' => '验证码错误']);
        }

        switch ($this->role){
            case 'Student':
                $this->roleModel = new Student();
                $arr = $this->roleModel->where('StuAccount',$acc)->first();
                if($arr != null){
                    $SysPass = $arr->StuPassword;
                    if ($pass == $SysPass){
                        Session::put('username',$arr->StuName.',同学欢迎您');
                        Session::put('useracc',$arr);
                        Session::put('sys_url','/sys/home/student');
                        return \redirect('/sys/home/student');
                    }else{
                        return redirect('/login')->withErrors(['loginErr'=>'密码错误']);
                    }
                }else{
                    return redirect('/login')->withErrors(['loginErr'=>'账号不存在']);
                }
                break;
            case 'Teacher':
                $this->roleModel = new Teacher();
                $arr = $this->roleModel->where('TeaAccount',$acc)->first();
                if($arr != null){
                    $SysPass = $arr->TeaPassword;
                    if ($pass == $SysPass){
                        Session::put('username',$arr->TeaName.',老师欢迎您');
                        Session::put('sys_url','/sys/home/teacher');
                        return \redirect('/sys/home/teacher');
                    }else{
                        return redirect('/login')->withErrors(['loginErr'=>'密码错误']);
                    }
                }else{
                    return redirect('/login')->withErrors(['loginErr'=>'账号不存在']);
                }
                break;
            case 'Dean':
                $this->roleModel = new Dean();
                $arr = $this->roleModel->where('EduMAccount',$acc)->first();
                if($arr != null){
                    $SysPass = $arr->EduMPassword;
                    if ($pass == $SysPass){
                        Session::put('username',$arr->EduMName.',老师欢迎您');
                        Session::put('useracc',$arr);
                        Session::put('sys_url','/sys/home/dean');
                        return \redirect('/sys/home/dean');
                    }else{
                        return redirect('/login')->withErrors(['loginErr'=>'密码错误']);
                    }
                }else{
                    return redirect('/login')->withErrors(['loginErr'=>'账号不存在']);
                }
                break;
        }
        return view('home');
    }

    public function add(){
        $stu = new Student();
        $stu->StuName = '钟教务';
        $stu->StuAccount = 'admin';
        $stu->StuPassword = '123';
        $stu->StuDepartment = '电气与计算机工程学院';
        $stu->StuPeriod = '2014级';
        $stu->StuMajorCode = '010202';
        $stu->StuClass = '计算机信息与科学';
        $stu->save();
    }
}