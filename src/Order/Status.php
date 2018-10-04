<?php

namespace Wstanley\Kitapi\Order;

use Wstanley\Kitapi\FunctionClass;

class Status extends FunctionClass
{
    protected $uri = 'order/status/get';

    protected $necessary = [

        'cargo_number'      => 'номер груза',
    ];

    protected $optional = [

        'cargo_number'    => 'номер груза'
    ];

    public function status()
    {
        return $this->response->status;
    }
}