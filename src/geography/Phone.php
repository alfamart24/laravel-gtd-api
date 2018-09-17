<?php

namespace Webadvance\Kitapiv2\Geography;

use Webadvance\Kitapiv2\FunctionClass;

class Phone extends FunctionClass
{
    public $optional = [

        'geography_city_id'    => 'Код города географии',
        'geography_address_id' => 'Код адреса географии',
    ];

    protected $uri = 'geography/phone/get-list';
}