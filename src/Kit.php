<?php

namespace Webadvance\Kitapiv2;

use Illuminate\Support\Facades\Facade;

class Kit extends Facade
{
    protected static function getFacadeAccessor()
    {
        parent::getFacadeAccessor();
        return 'kitapiv2';
    }
}