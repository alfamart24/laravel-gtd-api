<?php

namespace Wstanley\Kitapi\Tdd;

use Wstanley\Kitapi\FunctionClass;

class Country extends FunctionClass
{
    public $optional = [

        'code'    => 'Код страны',
    ];

    protected $uri = 'tdd/country/get-list';
}