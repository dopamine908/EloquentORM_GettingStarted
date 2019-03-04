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
}
