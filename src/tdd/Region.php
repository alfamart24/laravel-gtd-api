<?php

namespace Webadvance\Kitapiv2\Tdd;

use Webadvance\Kitapiv2\FunctionClass;

class Region extends FunctionClass
{
    public $optional = [

        'code'            => 'Код населенного пункта',
        'country_сode'    => 'Код страны',
    ];

    protected $uri = 'tdd/region/get-list';
}