<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Flight;

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
}
