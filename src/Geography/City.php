<?php

namespace Alfamart24\Gtdapi\Geography;

use Alfamart24\Gtdapi\FunctionClass;

class City extends FunctionClass
{
    public $optional = [

        'tdd_city_code' => 'Код города',
        'site'          => 'Код сайта',
    ];

    protected $uri = 'geography/city/get-list';
}
