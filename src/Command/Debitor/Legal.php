<?php

namespace Wstanley\Kitapi\Command\Debitor;

/*
 *      Юридическое лицо
 */

class Legal
{
    public static function necessary($dependent)
    {
        $params = [

            'name_ur'               => 'ФИО контактного лица (Юредическое лицо)',
            'organization_name_ur'  => 'Наименование организации',
            'organization_phone_ur' => 'Телефон организации',
            'inn_ur'                => 'ИНН (Юредическое лицо)',

            // 2 3
            'legal_country'         => 'Страна (ИП или Юр.лицо)',
            'legal_city'            => 'Город (ИП или Юр.лицо)',
            'legal_street'          => 'Улица (ИП или Юр.лицо)',
            'legal_house'           => 'Дом (ИП или Юр.лицо)',
            'legal_supp'            => 'Корпус (ИП или Юр.лицо)',
            'legal_room'            => 'Кв\Офис (ИП или Юр.лицо)',
        ];

        // условие  country_code
        switch ($dependent['country_code']) {

            case 'RU' :
                $params['kpp'] = 'КПП';
                break;

            case 'BY' :
                $params['unp_ur'] = 'УНП (Юредическое лицо)';
                break;

            case 'KZ' :
                $params['bin'] = 'БИН (Юредическое лицо)';
                break;

            default :
                break;
        }

        return $params;
    }
}