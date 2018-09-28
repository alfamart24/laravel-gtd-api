<?php

namespace Wstanley\Kitapi;

use Illuminate\Support\Facades\Facade;

class Kit extends Facade
{
    protected static function getFacadeAccessor()
    {
        parent::getFacadeAccessor();
        return 'kitapi';
    }
}