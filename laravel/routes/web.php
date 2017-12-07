<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('homePage');

Route::group(['middleware' => ['web']], function () {

    Route::any('/login','LoginController@login');

    Route::any('/captcha/{tmp}', 'KitController@captcha');

    Route::any('/sys/home/{role}', 'HomeController@toHome');

    Route::post('/dologin', 'LoginController@dologin');

    Route::any('/add','LoginController@add');

    Route::any('/logout','LogoutController@logout');

    Route::any('/admin/login-view','AdminController@login');

    Route::post('/admin/login','AdminController@doLogin');

    Route::any('/admin/logout','AdminController@Logout');

    Route::any('/admin/student','Admin\StudentController@Home');
    Route::any('/admin/student/delete/{id}','Admin\StudentController@DeleteUser');
    Route::post('/admin/student/add','Admin\StudentController@AddUser');

    Route::any('/admin/teacher','Admin\TeacherController@Home');
    Route::any('/admin/teacher/delete/{id}','Admin\TeacherController@DeleteUser');
    Route::any('/admin/teacher/add','Admin\TeacherController@AddUser');

    Route::any('/admin/dean','Admin\DeanController@Home');
    Route::any('/admin/dean/delete/{id}','Admin\DeanController@DeleteUser');
    Route::any('/admin/dean/add','Admin\DeanController@AddUser');

    Route::any('/admin/major','Admin\MajorController@Home');
    Route::any('/admin/major/delete/{id}','Admin\MajorController@DeleteMajor');
    Route::any('/admin/major/add','Admin\MajorController@AddMajor');

    Route::any('/admin/book','Admin\BookController@Home');
    Route::any('/admin/book/delete/{id}','Admin\BookController@DeleteBook');

    Route::any('/admin/bookorno','Admin\BookOrNoController@Home');
    Route::any('/admin/bookorno/delete/{id}','Admin\BookOrNoController@DeleteRecord');

    Route::any('/admin/error',function (){
       return view('errors');
    });

});