<?php

namespace Wstanley\Kitapi\Command\Debitor;

/*
 *  физическое лицо
 */

class Physical
{
    public static function necessary()
    {
        return [

            'debitor_type'          => 'Код города откуда (1-физик, 2-ип, 3-юрик)',

            'country_code'          => 'Код страны',
            'real_country'          => 'Страна (Физическое лицо)',
            'real_city'             => 'Город (Физическое лицо)',
            'real_street'           => 'Улица (Физическое лицо)',
            'real_house'            => 'Дом (Физическое лицо)',

            'real_contact_name'     => 'ФИО (Физическое лицо)',
            'real_contact_phone'    => 'Номер телефона (Физическое лицо)',
        ];
    }

    public static function optional()
    {
        return [

            'real_supp'         => 'Корпус (Физическое лицо)',
            'real_room'         => 'Кв\Офис (Физическое лицо)',
        ];
    }

    public static function dependent()
    {
        return [

        ];
    }
}