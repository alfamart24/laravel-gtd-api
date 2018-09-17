<?php

namespace Webadvance\Kitapiv2\Geography;

use Webadvance\Kitapiv2\FunctionClass;

class Schedule extends FunctionClass
{
    public $optional = [

        'geography_city_id'    => 'Код города географии',
        'geography_address_id' => 'Код адреса географии',
        'group_id'             => 'Код вида графика',
    ];

    protected $uri = 'geography/schedule/get-list';
}