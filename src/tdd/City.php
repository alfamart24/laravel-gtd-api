<?php

namespace Wstanley\Kitapi\Tdd;

use Wstanley\Kitapi\FunctionClass;

class City extends FunctionClass
{
    protected $optional = [

        'code'          => 'Код населенного пункта',
        'country_сode'  => 'Код страны',
        'region_сode'   => 'Код страны',
    ];

    protected $uri = 'tdd/city/get-list';
}