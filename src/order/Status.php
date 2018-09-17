<?php

namespace Webadvance\Kitapiv2\Order;

use Webadvance\Kitapiv2\FunctionClass;

class Status extends FunctionClass
{
    public $optional = [

        'cargo_number'    => 'номер груза'
    ];

    protected $uri = 'order/status/get';
}