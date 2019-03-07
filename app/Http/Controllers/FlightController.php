<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Flight;
use App\Model\ScopeFlight;

class FlightController extends Controller
{
    /**
     * 取得全部模型
     */
    public function getAll() {
        $flights = Flight::all();
        foreach ($flights as $flight) {
            dump($flight);
        }
    }

    /**
     * 取得有條件限制的模型
     */
    public function getWhere() {
        $flights = Flight::where('Active', 1)
            ->orderBy('Name', 'desc')
            ->take(5)
            ->get();
        foreach ($flights as $flight) {
            dump($flight);
        }
    }

    /**
     * 如果你需要處理上千筆 Eloquent 查詢結果
     * chunk 方法將會取得一個 Eloquent 模型的「分塊」，
     * 將它們送到給定的 閉包 (Closure) 進行處理。
     */
    public function chunk() {
        Flight::where('Active', 1)
        ->chunk(200, function ($flights) {
            foreach ($flights as $flight) {

            }
        });
    }

    /**
     * cursor 方法可以讓你使用指標來搜索資料庫記錄
     */
    public function cursor() {
        foreach (Flight::where('Active', 1)->cursor() as $flight) {

        }
    }

    /**
     * find
     * first
     *
     * findOrFail
     * firstOrFail
     * findOrFail 和 firstOrFail 方法會取得查詢的第一個結果。
     * 如果未能找到結果，Illuminate\Database\Eloquent\ModelNotFoundException 會拋出例外
     * 如果沒有捕獲例外，則會自動發送 404 HTTP 會應給使用者
     *
     * aggregate
     * 你也可以使用查詢建構器提供的 count、sum、max 和其他 aggregate 方法
     */
    public function find() {
        $flight_1 = Flight::find(1);
        $flight_2 = Flight::where('Active', 1)->first();
        $flight_3 = Flight::find([1, 2, 3]);
        dump($flight_1, $flight_2, $flight_3);

        $findOrFail_success = Flight::findOrFail(1);
        dump($findOrFail_success);
        $findOrFail_failed = Flight::findOrFail(999999);
        dump($findOrFail_failed);

        $firstOrFail_success = Flight::where('FlightId', '>', 1)->firstOrFail();
        dump($firstOrFail_success);
        $firstOrFail_failed = Flight::where('FlightId', '>', 999999)->firstOrFail();
        dump($firstOrFail_failed);

        $count = Flight::where('Active', 1)->count();
        $max = Flight::where('Active', 1)->max('price');
        dump($count, $max);
    }

    /**
     * 新增一筆資料
     */
    public function new_flight() {
        $flight = new Flight;
        $flight->Name = 'NewFlightName';
        $flight->Price = 81000;
        $flight->Active = 1;
        $flight->Destination = 'Taiwan';
        $flight->save();

        dump($flight);
    }

    /**
     * 修改原本的資料
     */
    public function update_flight() {
        $flight = Flight::find(1);
        $flight->Name = 'NewFlightName';
        $flight->Price = 81000;
        $flight->Active = 1;
        $flight->Destination = 'Taiwan';
        $flight->save();

        dump($flight);
    }

    /**
     * 可批量與不可批量Model設定
     * 新增一筆資料做demo
     */
    public function update_many() {
        Flight::create(['Name' =>'testname','Destination' => 'Taiwan123333',  'Price' => 10]);
    }

    /**
     * 其他建立方法
     * firstOrCreate
     * firstOrNew
     * updateOrCreate
     */
    public function firstOr () {
        /**
         * 找得到就返回
         * 找不到就新增
         */
        $flight = Flight::firstOrCreate([
            'Name' => 'testekna33',
            'Destination' => 'Taiw3t3333',
            'Price' => 1064
        ]);
        dump($flight);

        /**
         * 找得到就返回
         * 找不到就創造一個
         * 不新增
         * 需要->save()才會新增
         */
        $flight = Flight::firstOrNew([
            'Name' => 't123',
            'Destination' => 'T123',
            'Price' => 1064
        ]);
        dump($flight);

        /**
         * 找得到就更新
         * 找不到就新增
         */
        $flight = Flight::updateOrCreate([
            'Name' => 't1233',
            'Destination' => 'T1233',
            'Price' => 1064
            ],
            [
                'Price' => 81000
            ]);
        dump($flight);
    }

    /**
     * 刪除方法
     */
    public function delete_function() {
        $flight = Flight::find(1)->delete();
        dump($flight);

        $flight = Flight::destroy([2,3,4]);
        $flight = Flight::destroy(5);
        dump($flight);
    }

    /**
     * 軟刪除的相關用法
     */
    public function soft_delete() {
        /**
         * 有設定軟刪除欄位（delete_at）
         * 執行delete的時候會直接執行軟刪除指令
         * 會在delete_at欄位新增時間
         */
        $flight = Flight::find(7)->delete();

        /**
         * 要查詢有被軟刪除過的資料比需要使用withTrashed()方法
         */
        $flight = Flight::withTrashed()->where('FlightId', '=', 6)->first();
        dump($flight);

        /**
         * trashed()可以用來判斷物件是否有被軟刪除
         */
        if ($flight->trashed()) {
            dump('被軟刪除過的');
        }

        /**
         * 只取出有被軟刪除過的資料
         */
        $flight = Flight::onlyTrashed()->get();
        dump($flight);

        /**
         * restore()可以將軟刪除狀態恢復成正常存在
         */
        $flight = Flight::withTrashed()->where('FlightId', '=', 6)->first()->restore();
        dump($flight);

        /**
         * 強制刪除
         */
        $flight = Flight::withTrashed()->where('FlightId', '=', 7)->forceDelete();
        dump($flight);


    }

    /**
     * 查看全域Scope結果
     */
    public function global_scope() {
        /**
         * 全域Scope寫在Model的boot
         */
        dump(ScopeFlight::all());

        /**
         * 移除全域Scope
         */
        dump(ScopeFlight::withoutGlobalScope(\App\Scope\DemoScope::class)->get());

        /*
         * 移除所有或多個全域Scope
         */
        dump(ScopeFlight::withoutGlobalScopes()->get());
        dump(ScopeFlight::withoutGlobalScopes([
            \App\Scope\AScope::class,
            \App\Scope\BScope::class
        ])->get());
    }
}
