<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OutPutExcel extends Controller
{
    public function ExportExcel(Request $request){
        if($request->isMethod('post')){
            $postData = $request->all();
            $cellData = [
                ['序号','课程名称','教材名称','作者','出版社','出版年份','书号','获奖情况',
                    '是否自编教材','是否与中山大学出版社立项建设的系列教材','是否境外教材',
                    '参考价格','学生用书（本）','教师用书（本）','合计','发放班级']
            ];
            $arr = $postData['data'];
            for ($i = 0 ; $i < sizeof($arr) ; $i++){
                $subArr = [
                    $i+1,$arr[$i]['BookCourse'],$arr[$i]['BookName'],$arr[$i]['BookAuthor'],$arr[$i]['BookPublisher']
                    ,$arr[$i]['BookPubDate'],$arr[$i]['BookIsbn13'],$arr[$i]['BookAward'],$arr[$i]['BookByOwn']
                    ,$arr[$i]['BookWithSun'],$arr[$i]['BookFromAbroad'],$arr[$i]['BookPrice'],$arr[$i]['BookForStu']
                    ,$arr[$i]['BookForTea'],$arr[$i]['Amount'],$arr[$i]['BookToClass']
                ];
                array_push($cellData,$subArr);
            }
            Excel::create($postData['fileName'],function($excel) use ($cellData){
                $excel->setCreator('Dalsen')
                    ->setCompany('Dalsen-cop');
                $excel->sheet('BookLists', function($sheet) use ($cellData){
                    $sheet->cell('A1:P1',function ($cells){      //样式设置
                        $cells->setFontWeight('bold');
                        $cells->setAlignment('center');
                    });
                    $sheet->cell('A:P',function ($cells){
                        $cells->setAlignment('center');
                        $cells->setValignment('center');
                    });
                    $sheet->rows($cellData);
                    $sheet->setWidth(array(
                        'A'     =>  '8',
                        'B'     =>  '30',
                        'C'     =>  '30',
                        'D'     =>  '25',
                        'E'     =>  '30',
                        'F'     =>  '15',
                        'G'     =>  '20',
                        'H'     =>  '30',
                        'I'     =>  '20',
                        'J'     =>  '45',
                        'K'     =>  '20',
                        'L'     =>  '20',
                        'M'     =>  '20',
                        'N'     =>  '20',
                        'O'     =>  '20',
                        'P'     =>  '30',
                    ));
                });
            })->store('xls',storage_path('excel/exports'));
            $downloadPath = 'http://localhost/MaterialsSub/laravel/storage/excel/exports/'.$postData['fileName'].'.xls';
            return $downloadPath;
        }else{
            return response()->json([], 404, '请求未找到');
        }
    }
}
