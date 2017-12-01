<?php

namespace App\Http\Controllers;

use App\book080703;
use App\HadBooked;
use App\Major;
use Illuminate\Http\Request;
use PhpParser\Node\Scalar\String_;

class ApiController extends Controller
{
    //
    public function getMajor(){
        $major = new Major();
        $data = $major::all();
        return response()->json($data);
    }

    public function uploadImg(Request $request){
        if ($request->ajax()){
             $file = $request->file('photo');
            if ($file->isValid()) {
                // 获取文件相关信息
                $originalName = $file->getClientOriginalName(); // 文件原名
                $ext = $file->getClientOriginalExtension();     // 扩展名
                $realPath = $file->getRealPath();   //临时文件的绝对路径
                $type = $file->getClientMimeType();     // image/jpeg

                // 上传文件
                $filename = date('Ymd');
                // 使用我们新建的uploads本地存储空间（目录）
                $path = $file->store($filename, 'uploads');
                return response()->json([
                    'status_code' => 200,
                    'message' => 'success',
                    'photo' => asset('/uploads/'.$path),
                    'name' => $originalName,
                ]);

            } else {
                return response()->json([], 500, '文件未通过验证');
            }
        }
        return response()->json([], 404, '请求未找到');
    }

    public function saveBooks(Request $request){
        if($request->isMethod('post')){
            $books = $request->all();
            $len = sizeof($books);
            $count = 0;
            for ($i = 0 ; $i < $len ; $i++){
                $book = new book080703();
                $book->BookName = $books[$i]['BookName'];
                $book->BookAuthor = $books[$i]['BookAuthor'];
                $book->BookPubDate = $books[$i]['BookPubDate'];
                $book->BookImage = $books[$i]['BookImage'];
                $book->BookPublisher = $books[$i]['BookPublisher'];
                $book->BookIsbn13 = $books[$i]['BookIsbn13'];
                $book->BookPrice = $books[$i]['BookPrice'];
                $book->BookPages = $books[$i]['BookPages'];
                $book->BookAltUrl = $books[$i]['BookAltUrl'];
                $book->BookCourse = $books[$i]['BookCourse'];
                $book->BookAward = $books[$i]['BookAward'];
                $book->BookByOwn = $books[$i]['BookByOwn'];
                $book->BookWithSun = $books[$i]['BookWithSun'];
                $book->BookFromAbroad = $books[$i]['BookFromAbroad'];
                $book->BookForTea = $books[$i]['BookForTea'];
                $book->BookToClass = $books[$i]['BookToClass'];
                $book->Year = $books[$i]['Year'];
                $book->Semester = $books[$i]['Semester'];
                $book->Amount = $books[$i]['BookForTea'];
                $book->save();
                $count++;
            }
            if($len == $count){
                return response()->json([
                    'status_code' => 200,
                ]);
            }
            return $books;
        }else{
            return response()->json([], 404, '请求未找到');
        }
    }

    public function searchRecord(Request $request){
        if ($request->isMethod('post')){
            $query = $request->all();
            $book = new book080703();
            $result = $book->where('Year','=',$query['Year'])
                ->where('Semester','=',$query['Term'])
                ->where('BookToClass','=',$query['Major'])
                ->get();
            return response()->json([
                'status_code' => 200,
                'res' => $result
            ]);
        }else{
            return response()->json([], 404, '请求未找到');
        }
    }

    public function getBooks(Request $request){
        if($request->isMethod('post')){
            $query = $request->all();
            $books = new book080703();
            $res = $books->where('BookToClass','=',$query['period'])
                ->where('Year','=',$query['year'])
                ->where('Semester','=',$query['term'])
                ->get();
            return $res;
        }else{
            return response()->json([], 404, '请求未找到');
        }
    }

    public function addAmount(Request $request){
        if($request->isMethod('post')){
            $query = $request->all();
            $len = sizeof($query);
            $count = 0;
            $result = 'fail';
            for ($i = 0 ; $i < $len ; $i++){
                $books = new book080703();
                $res1 = $books->where('Year' ,'=',$query[$i]['Year'])
                        ->where('Semester','=',$query[$i]['Semester'])
                        ->where('BookToClass','=',$query[$i]['BookToClass'])
                        ->where('BookIsbn13','=',$query[$i]['BookIsbn13'])
                        ->increment('BookForStu');
                $res2 = $books->where('Year' ,'=',$query[$i]['Year'])
                    ->where('Semester','=',$query[$i]['Semester'])
                    ->where('BookToClass','=',$query[$i]['BookToClass'])
                    ->where('BookIsbn13','=',$query[$i]['BookIsbn13'])
                    ->increment('Amount');
                if($res1&&$res2)
                    $count++;
            }
            if($len == $count)
                $result = 'success';
            return response()->json(['status' => $result]);
        }else{
            return response()->json([], 404, '请求未找到');
        }
    }

    public function checkIfBooked(Request $request){
        if($request->isMethod('post')){
            $query = $request->all();
            $ifBooked  = new HadBooked();
            $res = $ifBooked->where('HadAccount','=',$query['stuAcc'])->get();
            if(sizeof($res) == 0){
                $ifBooked->HadAccount = $query['stuAcc'];
                $ifBooked->HadYear = $query['hadYear'];
                $ifBooked->HadSemester = $query['hadSemester'];
                $ifBooked->HadSubscribe = '0';
                $ifBooked->save();
                $result = $ifBooked->where('HadAccount','=',$query['stuAcc'])->get();
                return $result;
            }else{
                return $res;
            }
//            return $query;
        }else{
            return response()->json([], 404, '请求未找到');
        }
    }

    public function hadBooked(Request $request){
        if ($request->isMethod('post')){
            $query = $request->all();
            $booked = new HadBooked();
            $res = $booked->where('HadAccount','=',$query['stuAcc'])
                    ->where('HadYear','=',$query['hadYear'])
                    ->where('HadSemester','=',$query['hadSemester'])
                    ->update(['HadSubscribe' => '1']);
            return $res;
        }else{
            return response()->json([], 404, '请求未找到');
        }
    }

    public function getCurrentBooks(Request $request){
        if ($request->isMethod('post')){
            $query = $request->all();
            $book = new book080703();
            $books = $book->where('Year','=',$query['year'])
                            ->where('Semester','=',$query['term'])
                            ->get();
            return $books;
        }else{
            return response()->json([], 404, '请求未找到');
        }
    }

}
