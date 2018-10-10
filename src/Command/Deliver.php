<?php

namespace Wstanley\Kitapi\Command;

class Deliver
{
    /**
     * @return array
     */
    public static function necessary()
    {
        return [

            'delivery_date'         => 'Дата доставки',
            'delivery_time_start'   => 'Время начала доставки',
            'delivery_time_end'     => 'Время окончания доставки',
        ];
    }

    /**
     * @return array
     */
    public static function optional()
    {
        return [

            'delivery_supp'         => 'Корпус другого адреса получателя',
            'delivery_room'         => 'Офис/квартира другого адреса получателя',
            'delivery_house'        => 'Дом другого адреса получателя',
            'delivery_street'       => 'Улица другого адреса получателя',
            'delivery_r'            => 'Доставка на другой адрес получателя',
            'delivery_comment'      => 'Коментарий к доставке',
        ];
    }

    /**
     * @return array
     */
    public static function dependent()
    {
        return [

            1 => [
                'field'         => 'delivery_r',
                'depend'        => true,
                'sing'          => '=',
                'fieldDepend'   => ['delivery_street' => 'Улица другого адреса получателя',
                                    'delivery_house'  => 'Дом другого адреса получателя',]
            ],
        ];
    }
}