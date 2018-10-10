<?php

namespace Wstanley\Kitapi\Command\Debitor;

/*
 *  Индивидуальный предприниматель
 */
class Individual
{
    /**
     * @return array
     */
    public static function necessary()
    {
        return [

            'debitor_type'          => 'Код города откуда (1-физик, 2-ип, 3-юрик)',

            'country_code'          => 'Код страны',

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

    /**
     * @return array
     */
    public static function optional()
    {
        return [

            'unp_ip'                => 'УНП (ИП)',
            'iin'                   => 'УНП (ИП)',

            'legal_supp'            => 'Корпус (ИП или Юр.лицо)',
            'legal_room'            => 'Кв\Офис (ИП или Юр.лицо)',
        ];
    }

    /**
     * @return array
     */
    public static function dependent()
    {
        return [

            1 => [
                'field'         => 'country_code',
                'depend'        => 'BY',
                'sing'          => '=',
                'fieldDepend'   => 'unp_ip'
            ],

            2 => [
                'field'         => 'country_code',
                'depend'        => 'KZ',
                'sing'          => '=',
                'fieldDepend'   => 'iin'
            ],
        ];
    }
}