<?php

namespace App\Http\Controllers\Admin;

use App\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class TeacherController extends Controller
{
    public $tea;

    public function __construct()
    {
        $this->tea = new Teacher();
    }

    public function Home(){
        if(Session::get('name') == ""){
            return redirect('/admin/login-view')->withErrors(['loginErr' => 'You did not sign in!']);
        }else{
            $res = $this->tea::all();
            return view('admin.teacher',['teachers' => $res]);
        }
    }

    public function DeleteUser(Request $request){
        $id = $request->route('id');
        $res = $this->tea->where('Teaid','=',$id)->delete();
        if($res){
            return redirect('/admin/teacher');
        }else{
            return redirect('/admin/error');
        }
    }

    public function AddUser(Request $request){
        if($request->hasFile('excel')){
            $time = date('ymdhis',time());
            $file_ext = $request->file('excel')->extension();
            $fileName = $time.'.'.$file_ext;
            $file = $request->file('excel')->storeAs('excel/imports',$fileName);
            $savePath = storage_path('app/').$file;
            Excel::load($savePath,function ($reader){
                $results = $reader->all();
                for($i = 0 ; $i<sizeof($results);$i++){
                    $tea = new Teacher();
                    $tea->TeaName = $results[$i]['teaname'];
                    $tea->TeaAccount = $results[$i]['teaaccount'];
                    $tea->TeaPassword = $results[$i]['teapassword'];
                    $tea->TeaDepartment = $results[$i]['teadepartment'];
                    $tea->TeaEducation = $results[$i]['teaeducation'];
                    $tea->TeaPhone = $results[$i]['teaphone'];
                    $tea->TeaEmail = $results[$i]['teaemail'];
                    $tea->save();
                }
            });
            return redirect('/admin/teacher')->withErrors(['mes'=>'数据读取成功！']);
        }else{
            return redirect('/admin/teacher')->withErrors(['mes'=>'您未选择文件！']);
        }
    }
}
