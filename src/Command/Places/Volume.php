<?php

namespace Wstanley\Kitapi\Command\Places;

class Volume
{
    public static function necessary()
    {
        return [
            'count_place'   => 'Количество мест в позиции',
            'weight'        => 'Масса КГ позиции',
            'volume'        => 'Объем М³ позиции',
        ];
    }
}