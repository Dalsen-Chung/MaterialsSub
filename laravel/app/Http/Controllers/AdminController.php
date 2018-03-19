<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function login(){
        return view('admin.adminLogin');
    }


    public function doLogin(Request $request){
        $this->validate($request,[
            'Account' => 'required',
            'Password' => 'required'
        ]);

        $acc = $request->input('Account');
        $pass = $request->input('Password');

        $user = new Admin();
        $res = $user->where('AdmAccount','=',$acc)->first();
        if($res != null){
            if($pass == $res->AdmPassword){
                Session::put('name',$res->AdmName);
                return redirect('/admin/student');
            }else{
                return redirect('/admin/login-view')->withErrors(['fail' => 'Password Incorrect']);
            }
        }else{
            return redirect('/admin/login-view')->withErrors(['fail' => 'Account error']);
        }
    }

    public function Logout(Request $request){
        $request->session()->flush();
        return redirect('admin/login-view');
    }

}
