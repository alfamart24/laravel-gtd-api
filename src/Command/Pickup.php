<?php

namespace Wstanley\Kitapi\Command;

class Pickup
{
    /**
     * @return array
     */
    public static function necessary()
    {
        return [

            'pickup_date'       => 'Дата забора',
            'pickup_time_start' => 'Время начала забора',
            'pickup_time_end'   => 'Время окончания забора',
        ];
    }

    /**
     * @return array
     */
    public static function optional()
    {
        return [

            'pickup_supp'       => 'Корпус другого адреса отправителя',
            'pickup_room'       => 'Офис/квартира другого адреса отправителя',
            'pickup_house'      => 'Дом другого адреса отправителя',
            'pickup_street'     => 'Улица другого адреса отправителя',
            'pickup_r'          => 'Забор с другого адреса отправителя',
            'pickup_comment'    => 'Коментарий к забору груза',
        ];
    }

    /**
     * @return array
     */
    public static function dependent()
    {
        return [

            1 => [
                'field'         => 'pickup_r',
                'depend'        => true,
                'sing'          => '=',
                'fieldDepend'   => ['pickup_street' => 'Улица другого адреса отправителя',
                                    'pickup_house'  => 'Дом другого адреса отправителя',]
            ],
        ];
    }
}