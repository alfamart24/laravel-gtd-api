<?php

namespace Wstanley\Kitapi\Command\Debitor;

/*
 *      Юридическое лицо
 */
class Legal
{
    /**
     * @return array
     */
    public static function necessary()
    {
        return [

            'debitor_type'          => 'Код города откуда (1-физик, 2-ип, 3-юрик)',

            'country_code'          => 'Код страны',

            'name_ur'               => 'ФИО контактного лица (Юридическое лицо)',
            'organization_name_ur'  => 'Наименование организации',
            'organization_phone_ur' => 'Телефон организации',
            'phone_ur'              => 'ФИО контактного лица (Юридическое лицо)',
            'inn_ur'                => 'ИНН (Юридическое лицо)',

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

            'kpp'           => 'КПП',
            'bin'           => 'БИН (Юридическое лицо)',
            'unp_ur'        => 'УНП (Юридическое лицо)',

            'legal_supp'    => 'Корпус (ИП или Юр.лицо)',
            'legal_room'    => 'Кв\Офис (ИП или Юр.лицо)',
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
                'depend'        => 'RU',
                'sing'          => '=',
                'fieldDepend'   => 'kpp'
            ],

            2 => [
                'field'         => 'country_code',
                'depend'        => 'KZ',
                'sing'          => '=',
                'fieldDepend'   => 'bin'
            ],

            3 => [
                'field'         => 'country_code',
                'depend'        => 'BY',
                'sing'          => '=',
                'fieldDepend'   => 'unp_ur'
            ],
        ];
    }
}