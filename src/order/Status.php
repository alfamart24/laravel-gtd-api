<?php

namespace Wstanley\Kitapi\Order;

use Wstanley\Kitapi\FunctionClass;

class Status extends FunctionClass
{
    public $optional = [

        'cargo_number'    => 'номер груза'
    ];

    protected $uri = 'order/status/get';
}