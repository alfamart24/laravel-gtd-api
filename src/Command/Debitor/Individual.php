<?php

namespace Wstanley\Kitapi\Command\Debitor;

/*
 *  Индивидуальный предприниматель
 */

class Individual
{
    public static function necessary()
    {
        return [

            'name_ip'               => 'ФИО контактного лица (ИП)',
            'organization_name_ip'  => 'ФИО (ИП)',
            'organization_phone_ip' => 'Номер телефона (ИП)',
            'inn_ip'                => 'ИНН (ИП)',

            'legal_country'         => 'Страна (ИП или Юр.лицо)',
            'legal_city'            => 'Город (ИП или Юр.лицо)',
            'legal_street'          => 'Улица (ИП или Юр.лицо)',
            'legal_house'           => 'Дом (ИП или Юр.лицо)',
        ];
    }

    public static function optional()
    {
        return [

            'unp_ip'                => 'УНП (ИП)',
            'iin'                   => 'УНП (ИП)',

            'legal_supp'            => 'Корпус (ИП или Юр.лицо)',
            'legal_room'            => 'Кв\Офис (ИП или Юр.лицо)',
        ];
    }

    public static function dependent()
    {
        return [

            1 => [
                'field'         => 'country_code',
                'depend'        => 'BY',
                'sing'          => '=',
                'fieldDepend'   => ['unp_ip']
            ],

            2 => [
                'field'         => 'country_code',
                'depend'        => 'KZ',
                'sing'          => '=',
                'fieldDepend'   => ['iin']
            ],
        ];
    }
}