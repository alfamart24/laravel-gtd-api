<?php

namespace Webadvance\Kitapiv2\Tdd;

use Webadvance\Kitapiv2\FunctionClass;

class City extends FunctionClass
{
    protected $optional = [

        'code'          => 'Код населенного пункта',
        'country_сode'  => 'Код страны',
        'region_сode'   => 'Код страны',
    ];

    protected $uri = 'tdd/city/get-list';
}