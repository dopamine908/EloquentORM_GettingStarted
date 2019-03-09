<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\FlightObserver;
use App\Model\Flight;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * 可以在一個 AppServiceProvider 中
         * 使用 boot 方法來註冊 Observer
         */
        Flight::observe(FlightObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
