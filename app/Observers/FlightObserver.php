<?php

namespace App\Observers;

use App\Model\Flight;

class FlightObserver
{
    /**
     * 監聽Flight被建立事件。
     *
     * @param  \App\Model\Flight  $flight
     * @return void
     */
    public function created(Flight $flight)
    {
        dump('Observer : 監聽到你新增了一個檔案');
    }
}