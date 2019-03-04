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

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| 取得模型
|--------------------------------------------------------------------------
能夠取得多個結果的 Eloquent 方法
會回傳 Illuminate\Database\Eloquent\Collection 實例
可使用 Collection 預設的方法
*/
Route::get('取得全部Flight', 'FlightController@getAll');
Route::get('取得有條件限制的Flight', 'FlightController@getWhere');

/*
|--------------------------------------------------------------------------
| find, first, findOrFail, firstOrFail, aggregate
|--------------------------------------------------------------------------
*/
Route::get('find', 'FlightController@find');

/*
|--------------------------------------------------------------------------
| 新增＆修改
|--------------------------------------------------------------------------
*/
Route::get('new', 'FlightController@new_flight');
Route::get('update', 'FlightController@update_flight');