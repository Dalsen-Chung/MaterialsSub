<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 2017/9/12
 * Time: 14:32
 */
namespace App\Http\Controllers;

use Gregwar\Captcha\CaptchaBuilder;

use Illuminate\Support\Facades\Session;

class KitController extends Controller
{
    public function captcha($temp){
        //生成Captcha
        $builder = new CaptchaBuilder();
        $builder->build($width = 100 , $height = 36 , $font = null);
        $phrase = $builder->getPhrase();

        //将内容存入Session
        Session::put('captcha',$phrase);
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }
}