<?php

namespace App\Providers;

use App\BankCardOrder;
use App\Observers\BankCardOrderObserver;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         *  申请办卡 队列执行
         */
        BankCardOrder::observe(BankCardOrderObserver::class);
    }
}
