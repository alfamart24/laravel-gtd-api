<?php

namespace Wstanley\Kitapi\Order;

class Greate
{
    protected $uri = 'order/create';

    protected $necessary = [

        'city_pickup_code'   => 'Код города откуда',
        'city_delivery_code' => 'Код города куда',
        'type'               => 'Вид перевозки',
        'declared_price'     => 'Объявленная стоимость груза (руб)',

        'customer'           => 'Заказчик',
        'sender'             => 'Отправитель',
        'receiver'           => 'Получатель',

        'count_place'        => 'Количество мест в позиции',
        'weight'             => 'Масса КГ позиции',
    ];

    protected $optional = [

        'debitor'      => 'Номер дебитора',

        'height'            => 'Высота груза (см) позиции',
        'width'             => 'Ширина груза (см) позиции',
        'length'            => 'Длина груза (см) позиции',
        'volume'            => 'Объем М³ позиции',

        'cargo_type_code'       => 'Код характера груза',
        'service'               => 'Массив кодов услуг',
        'confirmation_price'    => 'Наличие документов подтверждающих стоимость',

        'pick_up'           => 'Забор груза',
        'pickup_comment'    => 'Коментарий к забору груза',
        'pickup_r'          => 'Забор с другого адреса отправителя',
        'pickup_date'       => 'Дата забора',
        'pickup_time_start' => 'Время начала забора',
        'pickup_time_end'   => 'Время окончания забора',
        'pickup_street'     => 'Улица другого адреса отправителя',
        'pickup_house'      => 'Дом другого адреса отправителя',
        'pickup_supp'       => 'Корпус другого адреса отправителя',
        'pickup_room'       => 'Офис/квартира другого адреса отправителя',

        'deliver'               => 'Доставка груза по городу',
        'delivery_date'         => 'Дата доставки',
        'delivery_time_start'   => 'Время начала доставки',
        'delivery_time_end'     => 'Время окончания доставки',
        'delivery_comment'      => 'Коментарий к доставке',
        'delivery_r'            => 'Доставка на другой адрес получателя',
        'delivery_street'       => 'Улица другого адреса получателя',
        'delivery_house'        => 'Дом другого адреса получателя',
        'delivery_supp'         => 'Корпус другого адреса получателя',
        'delivery_room'         => 'Офис/квартира другого адреса получателя',

        'additional_payment_shipping'   => 'Плательщик перевозки',
        'additional_payment_pickup'     => 'Плательщик забора груза',
        'additional_payment_shipping-1' => 'Плательщик доставки груза',

        'insurance'             => 'Услуга страхования груза',
        'insurance_agent_code'  => 'Код страхового агента',
        'have_doc'              => 'Есть документы подтверждающие стоимость груза',

        'currency_code'         => 'Валюта результата расчета',
        'dispatch_address_code' => 'Адрес терминала отправки',
        'all_places_same'       => 'Все места одинаковы по размеру',
    ];

    //  обязательные поля по условию
    private $dependent = [

        1 => [
            'field'         => 'declared_price',
            'depend'        => 50000,
            'sing'          => '>',
            'fieldDepend'   => ['confirmation_price', 'have_doc']
        ],

        2 => [
            'field'         => 'declared_price',
            'depend'        => 10000,
            'sing'          => '>=',
            'fieldDepend'   => 'insurance'
        ],

        3 => [
            'field'         => 'pick_up',
            'depend'        => true,
            'sing'          => '=',
            'fieldDepend'   => ['pickup_date', 'pickup_time_start', 'pickup_time_end']
        ],

        4 => [
            'field'         => ['pick_up', 'pickup_r'],
            'depend'        => true,
            'sing'          => '=',
            'fieldDepend'   => ['pickup_street', 'pickup_house']
        ],

        5 => [
            'field'         => 'deliver',
            'depend'        => true,
            'sing'          => '=',
            'fieldDepend'   => ['delivery_date', 'delivery_time_start', 'delivery_time_end']
        ],

        6 => [
            'field'         => 'delivery_r',
            'depend'        => true,
            'sing'          => '=',
            'fieldDepend'   => ['delivery_street', 'delivery_house']
        ],

        7 => [
            'field'         => 'insurance',
            'depend'        => true,
            'sing'          => '=',
            'fieldDepend'   => 'insurance_agent_code'
        ],

        8 => [
            'field'         => 'pick_up',
            'depend'        => false,
            'sing'          => '=',
            'fieldDepend'   => ['dispatch_address_code']
        ],
    ];


}