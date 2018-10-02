<?php

namespace Wstanley\Kitapi\Tdd;

use Wstanley\Kitapi\FunctionClass;

class City extends FunctionClass
{
    protected $optional = [

        'code'          => 'Код населенного пункта',
        'country_code'  => 'Код страны',
        'region_code'   => 'Код страны',
    ];

    protected $uri = 'tdd/city/get-list';
}