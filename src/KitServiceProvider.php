<?php

namespace Webadvance\Kitapiv2;

use Illuminate\Support\ServiceProvider;

class KitServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->singleton('kitapiv2', function ($app){

            return new KitService();
        });
    }
}