<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2017/9/12
 * Time: 17:32
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }

    public function dologin(Request $request){
        $acc = $request->input('account');
        $pass = $request->input('password');
        if(Auth::attempt(['email' => $acc, 'password' => $pass])){
            dd('ok');
        }else{
            dd('error');
        }
    }
}