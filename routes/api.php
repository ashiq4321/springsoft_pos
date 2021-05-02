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
Route::get('category','Api\CategoryApiController@index');
Route::get('question/{category_id}','Api\QuestionApiController@index');
Route::get('user/{user_id}','Api\UserApiController@index');
Route::post('answer/{id}','Api\AnswerApiController@answer');
