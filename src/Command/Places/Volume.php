<?php

namespace Wstanley\Gtdapi\Command\Places;

class Volume
{
    /**
     * @return array
     */
    public static function necessary()
    {
        return [
            'count_place'   => 'Количество мест в позиции',
            'weight'        => 'Масса КГ позиции',
            'volume'        => 'Объем М³ позиции',
        ];
    }
}