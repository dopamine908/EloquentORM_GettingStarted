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

/*
|--------------------------------------------------------------------------
| 可批量與不可批量Model設定
|--------------------------------------------------------------------------
*/
Route::get('update_many', 'FlightController@update_many');

/*
|--------------------------------------------------------------------------
| 其他建立方法
|--------------------------------------------------------------------------
firstOrCreate
firstOrNew
updateOrCreate
*/
Route::get('找不到就新增', 'FlightController@firstOr');

/*
|--------------------------------------------------------------------------
| 刪除方法
|--------------------------------------------------------------------------
*/
Route::get('刪除方法', 'FlightController@delete_function');

/*
|--------------------------------------------------------------------------
| 軟刪除相關方法
|--------------------------------------------------------------------------
*/
Route::get('軟刪除', 'FlightController@soft_delete');

/*
|--------------------------------------------------------------------------
| 全域Scope
|--------------------------------------------------------------------------
*/
Route::get('全域Scope', 'FlightController@global_scope');

/*
|--------------------------------------------------------------------------
| 局部Scope
|--------------------------------------------------------------------------
*/
Route::get('局部Scope', 'FlightController@local_scope');

/*
|--------------------------------------------------------------------------
| 動態Scope
|--------------------------------------------------------------------------
*/
Route::get('動態Scope', 'FlightController@dynamic_scope');

/*
|--------------------------------------------------------------------------
| Model事件
|--------------------------------------------------------------------------
可以對於Model的生命週期中的動作執行時
例如retrieved、creating、created、updating、updated、saving、saved、
   deleting、deleted、restoring、restored
指定要觸發的程式碼

https://9iphp.com/series/how-to-use-events-and-observers-in-laravel
https://9iphp.com/web/laravel/model-events-in-laravel.html
*/

Route::get('模型事件', 'FlightController@flight_created_event');

/*
|--------------------------------------------------------------------------
| Model事件
|--------------------------------------------------------------------------
可以對於Model的生命週期中的動作執行時
例如retrieved、creating、created、updating、updated、saving、saved、
   deleting、deleted、restoring、restored
指定要觸發的程式碼
如果你在給定模型上監聽多個事件
可以使用 Observer 來組織你的所有監聽器到單一個類別。

https://9iphp.com/series/how-to-use-events-and-observers-in-laravel
*/

Route::get('監聽Model', 'FlightController@flight_created_event');