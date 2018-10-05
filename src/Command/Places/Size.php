<?php

namespace Wstanley\Kitapi\Command\Places;

class Size
{
    public static function necessary()
    {
        return [
            'count_place'   => 'Количество мест в позиции',
            'weight'        => 'Масса КГ позиции',
            'height'        => 'Высота груза (см) позиции',
            'width'         => 'Ширина груза (см) позиции',
            'length'        => 'Длина груза (см) позиции'
        ];
    }
}