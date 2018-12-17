<?php

namespace Alfamart24\Gtdapi;

use Illuminate\Support\ServiceProvider;

class GtdServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->singleton('gtdapi', function ($app){

            return new GtdService();
        });
    }
}
