<?php

namespace Wstanley\Kitapi\Command;


class Debitor
{
    protected $necessary = [

        'debitor'      => 'Номер дебитора',
    ];

    protected $optional = [

        'debitor_type'    => 'Код города откуда (1-физик, 2-ип 3-юрик)',
        'country_code'    => 'Код страны',

        // 1
        'real_country'    => 'Страна (Физическое лицо)',
        'real_city'       => 'Город (Физическое лицо)',
        'real_street'       => 'Улица (Физическое лицо)',
        'real_house'       => 'Дом (Физическое лицо)',
        'real_supp'       => 'Корпус (Физическое лицо)',
        'real_room'       => 'Кв\Офис (Физическое лицо)',
        'real_contact_name'   => 'ФИО (Физическое лицо)',
        'real_contact_phone'  => 'Номер телефона (Физическое лицо)',

        // 2
        'name_ip'               => 'ФИО контактного лица (ИП)',
        'organization_name_ip'  => 'ФИО (ИП)',
        'organization_phone_ip' => 'Номер телефона (ИП)',
        'inn_ip'                => 'ИНН (ИП)',
        'unp_ip'                => 'УНП (ИП)',  //todo условие дописать country_code =BY
        'iin'                   => 'УНП (ИП)',  //todo условие дописать country_code =KZ


        // 3
        'kpp'                   => 'КПП', //todo условие дописать country_code =RU
        'name_ur'               => 'ФИО контактного лица (Юредическое лицо)',
        'organization_name_ur'   => 'Наименование организации',
        'organization_phone_ur'   => 'Телефон организации',
        'unp_ur'               => 'УНП (Юредическое лицо)', //todo условие дописать country_code =BY
        'inn_ur'               => 'ИНН (Юредическое лицо)',
        'bin'               => 'БИН (Юредическое лицо)',//todo условие дописать country_code =KZ


        // 2 3
        'legal_country'       => 'Страна (ИП или Юр.лицо)',
        'legal_city'       => 'Город (ИП или Юр.лицо)',
        'legal_street'       => 'Улица (ИП или Юр.лицо)',
        'legal_house'       => 'Дом (ИП или Юр.лицо)',
        'legal_supp'       => 'Корпус (ИП или Юр.лицо)',
        'legal_room'       => 'Кв\Офис (ИП или Юр.лицо)',

    ];

    //  обязательные поля по условию
    private $dependent = [

        1 => [
            'field'         => 'debitor',
            'depend'        => false,
            'sing'          => '=',
            'fieldDepend'   => ['debitor_type', ]
        ],

        2 => [
            'field'         => 'debitor_type',
            'depend'        => 1,
            'sing'          => '=',
            'fieldDepend'   => ['country_code', 'real_country',
                'real_city', 'real_street', 'real_house',
                'real_contact_name', 'real_contact_phone']
        ],

        3 => [
            'field'         => 'debitor_type',
            'depend'        => 2,
            'sing'          => '=',
            'fieldDepend'   => []
        ],

        4 => [
            'field'         => 'debitor_type',
            'depend'        => 3,
            'sing'          => '=',
            'fieldDepend'   => []
        ],

    ];
}