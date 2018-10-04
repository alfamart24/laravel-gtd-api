<?php

namespace Wstanley\Kitapi\Command\Places;

use Wstanley\Kitapi\Command\CommandInterface;

class Size implements CommandInterface
{
    public $count_place   = 'Количество мест в позиции';
    public $weight        = 'Масса КГ позиции';
    public $height        = 'Высота груза (см) позиции';
    public $width         = 'Ширина груза (см) позиции';
    public $length        = 'Длина груза (см) позиции';
}