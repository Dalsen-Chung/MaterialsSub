<?php

namespace App\Http\Controllers\Admin;

use App\Major;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class MajorController extends Controller
{
    private $major;

    public function __construct()
    {
        $this->major = new Major();
    }

    public function Home(){
        if(Session::get('name') == ""){
            return redirect('/admin/login-view')->withErrors(['loginErr' => 'You did not sign in!']);
        }else{
            $res = $this->major::all();
            return view('admin.major',['majors' => $res]);
        }
    }

    public function DeleteMajor(Request $request){
        $id = $request->route('id');
        $res = $this->major->where('Majorid','=',$id)->delete();
        if($res){
            return redirect('/admin/major');
        }else{
            return redirect('/admin/error');
        }
    }

    public function AddMajor(Request $request){
        if($request->hasFile('excel')){
            $time = date('ymdhis',time());
            $file_ext = $request->file('excel')->extension();
            $fileName = $time.'.'.$file_ext;
            $file = $request->file('excel')->storeAs('excel/imports',$fileName);
            $savePath = storage_path('app/').$file;
            Excel::load($savePath,function ($reader){
                $results = $reader->all();
                for($i = 0 ; $i<sizeof($results);$i++){
                    $major = new Major();
                    $major->MajorName = $results[$i]['majorname'];
                    $major->MajorCode = $results[$i]['majorcode'];
                    $major->MajorDep = $results[$i]['majordep'];
                    $major->save();
                }
            });
            return redirect('/admin/major')->withErrors(['mes'=>'数据读取成功！']);
        }else{
            return redirect('/admin/major')->withErrors(['mes'=>'您未选择文件！']);
        }
    }
}
