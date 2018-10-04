<?php

namespace Wstanley\Kitapi\Geography;

use Wstanley\Kitapi\FunctionClass;

class City extends FunctionClass
{
    public $optional = [

        'tdd_city_code' => 'Код города',
        'site'          => 'Код сайта',
    ];

    protected $uri = 'geography/city/get-list';
}