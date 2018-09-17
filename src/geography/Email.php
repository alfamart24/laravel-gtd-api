<?php

namespace Webadvance\Kitapiv2\Geography;

use Webadvance\Kitapiv2\FunctionClass;

class Email extends FunctionClass
{
    public $optional = [

        'geography_city_id'    => 'Код города географии',
        'geography_address_id' => 'Код адреса географии',
    ];

    protected $uri = 'geography/email/get-list';
}