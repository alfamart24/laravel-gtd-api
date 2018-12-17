<?php

namespace Alfamart24\Gtdapi\Tdd;

use Alfamart24\Gtdapi\FunctionClass;

class Region extends FunctionClass
{
    public $optional = [

        'code'            => 'Код населенного пункта',
        'country_code'    => 'Код страны',
    ];

    protected $uri = 'tdd/region/get-list';
}
