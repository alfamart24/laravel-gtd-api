<?php

namespace Wstanley\Kitapi\Order;

use Wstanley\Kitapi\FunctionClass;
use Wstanley\Kitapi\Helpers\ArrayHelp;

class Calculate extends FunctionClass
{
    protected $necessary = [

        'city_pickup_code'      => 'Код города откуда',
        'city_delivery_code'    => 'Код города куда',
        'declared_price'        => 'Объявленная стоимость груза (руб)',
        'height'                => 'Высота груза (см) позиции',
        'width'                => 'Ширина груза (см) позиции',
        'length'                => 'Длина груза (см) позиции',
        'count_place'           => 'Количество мест в позиции',
        'weight'                => 'Масса КГ позиции',

        //  пока убрал
//        'volume'                => 'Объем М³ позиции',
    ];

    protected $optional = [

        'have_doc'              => 'Есть документы подтверждающие стоимость груза',
        'insurance'             => 'Услуга страхования груза',
        'insurance_agent_code'  => 'Код страхового агента',
        'service'               => 'массив кодов услуг',
        'pick_up'               => 'Забор груза по городу',
        'delivery'              => 'Доставка груза по городу',
        'cargo_type_code'       => 'Код характера груза',
        'currency_code'         => 'Валюта результата расчета',
        'all_places_same'       => 'Все места одинаковы по размеру'
    ];

    protected $uri = 'order/calculate';

    public function __construct(array $params = array())
    {
        parent::__construct($params);

        $this->params = ArrayHelp::getPlaces($this->params);
    }

    public function standart()
    {
        return ArrayHelp::calculateResult($this->response, 'standart');
    }

    public function economy()
    {
        return ArrayHelp::calculateResult($this->response, 'economy');
    }

    public function express()
    {
        return ArrayHelp::calculateResult($this->response, 'express');
    }

    public function standard_courier()
    {
        return ArrayHelp::calculateResult($this->response, 'standard_courier');
    }

    public function express_courier()
    {
        return ArrayHelp::calculateResult($this->response, 'express_courier');
    }
}