<?php

namespace Wstanley\Kitapi\Command\Places;

use Wstanley\Kitapi\Command\CommandInterface;

class Volume implements CommandInterface
{
    public $count_place   = 'Количество мест в позиции';
    public $weight        = 'Масса КГ позиции';
    public $volume        = 'Объем М³ позиции';
}