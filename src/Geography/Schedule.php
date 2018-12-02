<?php

namespace Wstanley\Gtdapi\Geography;

use Wstanley\Gtdapi\FunctionClass;

class Schedule extends FunctionClass
{
    public $optional = [

        'geography_city_id'    => 'Код города географии',
        'geography_address_id' => 'Код адреса географии',
        'group_id'             => 'Код вида графика',
    ];

    protected $uri = 'geography/schedule/get-list';
}