<?php

namespace App\Http\Controllers\Admin;

use App\HadBooked;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class BookOrNoController extends Controller
{
    private $bookorno;

    public function __construct()
    {
        $this->bookorno = new HadBooked();
    }

    public function Home(){
        if(Session::get('name') == ""){
            return redirect('/admin/login-view')->withErrors(['loginErr' => 'You did not sign in!']);
        }else{
            $res = $this->bookorno::all();
            return view('admin.bookorno',['bookorno' => $res]);
        }
    }

    public function DeleteRecord(Request $request){
        $id = $request->route('id');
        $res = $this->bookorno->where('HadId','=',$id)->delete();
        if($res){
            return redirect('/admin/bookorno');
        }else{
            return redirect('/admin/error');
        }
    }
}
