<?php

namespace App\Http\Controllers\Admin;

use App\book080703;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    private $book;

    public function __construct()
    {
        $this->book = new book080703();
    }

    public function Home(){
        if(Session::get('name') == ""){
            return redirect('/admin/login-view')->withErrors(['loginErr' => 'You did not sign in!']);
        }else{
            $res = $this->book::all();
            return view('admin.book',['books' => $res]);
        }
    }

    public function DeleteBook(Request $request){
        $id = $request->route('id');
        $res = $this->book->where('BookId','=',$id)->delete();
        if($res){
            return redirect('/admin/book');
        }else{
            return redirect('/admin/error');
        }
    }
}
