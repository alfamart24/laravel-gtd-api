<?php

namespace Wstanley\Gtdapi\Tdd;

use Wstanley\Gtdapi\FunctionClass;

class City extends FunctionClass
{
    protected $optional = [

        'code'          => 'Код населенного пункта',
        'country_code'  => 'Код страны',
        'region_code'   => 'Код страны',
    ];

    protected $uri = 'tdd/city/get-list';

    private $cities = [];

    public function cities()
    {
        foreach ($this->response as $item) {
            $this->cities[$item->code] = $item->name;
        }
        return $this->cities;
    }
}