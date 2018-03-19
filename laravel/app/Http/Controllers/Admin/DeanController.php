<?php

namespace App\Http\Controllers\Admin;

use App\Dean;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class DeanController extends Controller
{
    private $dean;

    public function __construct()
    {
        $this->dean = new Dean();
    }

    public function Home(){
        if(Session::get('name') == ""){
            return redirect('/admin/login-view')->withErrors(['loginErr' => 'You did not sign in!']);
        }else{
            $res = $this->dean::all();
            return view('admin.dean',['deans' => $res]);
        }
    }

    public function DeleteUser(Request $request){
        $id = $request->route('id');
        $res = $this->dean->where('EduMId','=',$id)->delete();
        if($res){
            return redirect('/admin/dean');
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
                    $dean = new Dean();
                    $dean->EduMName = $results[$i]['edumname'];
                    $dean->EduMAccount = $results[$i]['edumaccount'];
                    $dean->EduMPassword = $results[$i]['edumpassword'];
                    $dean->EduMDepartment = $results[$i]['edumdepartment'];
                    $dean->EduMPosition = $results[$i]['edumposition'];
                    $dean->EduMPhone = $results[$i]['edumphone'];
                    $dean->EduMEmail = $results[$i]['edumemail'];
                    $dean->save();
                }
            });
            return redirect('/admin/dean')->withErrors(['mes'=>'数据读取成功！']);
        }else{
            return redirect('/admin/dean')->withErrors(['mes'=>'您未选择文件！']);
        }
    }
}
