<?php

namespace Webadvance\Kitapiv2\Geography;

use Webadvance\Kitapiv2\FunctionClass;

class City extends FunctionClass
{
    public $optional = [

        'tdd_city_code' => 'Код города',
        'site'          => 'Код сайта',
    ];

    protected $uri = 'geography/city/get-list';
}