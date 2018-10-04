<?php

namespace Wstanley\Kitapi\Tdd;

use Wstanley\Kitapi\FunctionClass;

class Region extends FunctionClass
{
    public $optional = [

        'code'            => 'Код населенного пункта',
        'country_code'    => 'Код страны',
    ];

    protected $uri = 'tdd/region/get-list';
}