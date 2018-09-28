<?php

namespace Wstanley\Kitapi;

use Illuminate\Support\ServiceProvider;

class KitServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->singleton('kitapi', function ($app){

            return new KitService();
        });
    }
}