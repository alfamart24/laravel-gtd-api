<?php

namespace Wstanley\Kitapi\Geography;

use Wstanley\Kitapi\FunctionClass;

class Phone extends FunctionClass
{
    public $optional = [

        'geography_city_id'    => 'Код города географии',
        'geography_address_id' => 'Код адреса географии',
    ];

    protected $uri = 'geography/phone/get-list';
}