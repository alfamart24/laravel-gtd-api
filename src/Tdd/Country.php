<?php

namespace Wstanley\Gtdapi\Tdd;

use Wstanley\Gtdapi\FunctionClass;

class Country extends FunctionClass
{
    public $optional = [

        'code'    => 'Код страны',
    ];

    protected $uri = 'tdd/country/get-list';
}