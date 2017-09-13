<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2017/9/13
 * Time: 9:06
 */

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function toHome(){
        return view('System.home');
    }
}