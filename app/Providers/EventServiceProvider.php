<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Model\Flight;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        /**
         * 新增的時候會經過created這個動作
         * 這裡可以設定只要created有被執行到
         * 就執行某些事情
         */
        Flight::created(function($flight)
        {
            // doing something here, after Flight creation...
            echo "已新增";
        });

        /**
         * 儲存資料的時候會經過saved這個動作
         * 這裡可以設定只要saved有被執行到
         * 就執行某些事情
         */
        Flight::saved(function($flight)
        {
            // doing something here, after Flight save operation (both create and update)...
        });
    }
}
