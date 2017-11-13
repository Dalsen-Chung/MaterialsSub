<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2017/11/8
 * Time: 10:15
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;



class LogoutController extends Controller
{
    public function logout(Request $request){
        $request->session()->flush();
        return redirect()->route('homePage');
    }

}