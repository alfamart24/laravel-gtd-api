<?php

namespace Webadvance\Kitapiv2\Tdd;

use Webadvance\Kitapiv2\FunctionClass;

class Country extends FunctionClass
{
    public $optional = [

        'code'    => 'Код страны',
    ];

    protected $uri = 'tdd/country/get-list';
}