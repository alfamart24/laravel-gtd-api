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
            'unp_ip'                => 'УНП (ИП)',  //todo условие дописать country_code =BY
            'iin'                   => 'УНП (ИП)',  //todo условие дописать country_code =KZ

            // 2 3
            'legal_country'         => 'Страна (ИП или Юр.лицо)',
            'legal_city'            => 'Город (ИП или Юр.лицо)',
            'legal_street'          => 'Улица (ИП или Юр.лицо)',
            'legal_house'           => 'Дом (ИП или Юр.лицо)',
            'legal_supp'            => 'Корпус (ИП или Юр.лицо)',
            'legal_room'            => 'Кв\Офис (ИП или Юр.лицо)',
        ];
    }
}