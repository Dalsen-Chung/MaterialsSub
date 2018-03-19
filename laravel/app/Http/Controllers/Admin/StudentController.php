<?php

namespace App\Http\Controllers\Admin;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    private $stu;

    public function __construct()
    {
        $this->stu = new Student();
    }

    public function Home(){
        if(Session::get('name') == ""){
            return redirect('/admin/login-view')->withErrors(['loginErr' => 'You did not sign in!']);
        }else{
            $res = $this->stu::all();
            return view('admin.student',['students' => $res]);
        }
    }

    public function DeleteUser(Request $request){
        $id = $request->route('id');
        $res = $this->stu->where('StuID','=',$id)->delete();
        if($res){
            return redirect('/admin/student');
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
                    $stu = new Student();
                    $stu->StuName = $results[$i]['stuname'];
                    $stu->StuAccount = $results[$i]['stuaccount'];
                    $stu->StuPassword = $results[$i]['stupassword'];
                    $stu->StuDepartment = $results[$i]['studepartment'];
                    $stu->StuPeriod = $results[$i]['stuperiod'];
                    $stu->StuMajorCode = $results[$i]['stumajorcode'];
                    $stu->StuClass = $results[$i]['stuclass'];
                    $stu->save();
                }
            });
            return redirect('/admin/student')->withErrors(['mes'=>'数据读取成功！']);
        }else{
            return redirect('/admin/student')->withErrors(['mes'=>'您未选择文件！']);
        }
    }
}
