<?php

namespace Alfamart24\Gtdapi\Tdd;

use Alfamart24\Gtdapi\FunctionClass;

class Country extends FunctionClass
{
    public $optional = [

        'code'    => 'Код страны',
    ];

    protected $uri = 'tdd/country/get-list';
}
