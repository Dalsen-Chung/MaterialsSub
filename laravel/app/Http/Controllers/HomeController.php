<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2017/9/13
 * Time: 9:06
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function toHome($role){
        if(Session::get('username') == ""){
            return view('login')->with(['loginErr' => '您未登录']);
        }else{
            switch ($role){
                case 'teacher':
                    return view('System.teacher');
                    break;
                case 'dean':
                    return view('System.dean');
                    break;
                case 'student':
                    return view('System.student');
                    break;
            }
        }
    }
}