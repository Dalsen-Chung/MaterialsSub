<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix'=>'/v1',
    'middleware' => ['api']], function () {
    Route::any('/getmajor','ApiController@getMajor');
    Route::any('/uploadimg','ApiController@uploadImg');
    Route::any('/savebooks','ApiController@saveBooks');
    Route::any('/searchrecord','ApiController@searchRecord');
    Route::any('/getbooks','ApiController@getBooks');
    Route::any('/addamount','ApiController@addAmount');
    Route::any('/checkifbooked','ApiController@checkIfBooked');
    Route::any('/hadbooked','ApiController@hadBooked');
    Route::any('/getcurrentbooks','ApiController@getcurrentbooks');
});
