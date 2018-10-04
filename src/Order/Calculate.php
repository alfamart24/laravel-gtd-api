<?php

namespace Wstanley\Kitapi\Order;

use Wstanley\Kitapi\Command\CommandBus;
use Wstanley\Kitapi\Command\Places\Size;
use Wstanley\Kitapi\Command\Places\Volume;
use Wstanley\Kitapi\FunctionClass;
use Wstanley\Kitapi\Helpers\ArrayHelp;
use Wstanley\Kitapi\Helpers\Validation;

class Calculate extends FunctionClass
{
    protected $uri = 'order/calculate';

    protected $necessary = [

        'city_pickup_code'      => 'Код города откуда',
        'city_delivery_code'    => 'Код города куда',
        'declared_price'        => 'Объявленная стоимость груза (руб)',

        'count_place'           => 'Количество мест в позиции',
        'weight'                => 'Масса КГ позиции',
    ];

    protected $optional = [

        'height'                => 'Высота груза (см) позиции',
        'width'                 => 'Ширина груза (см) позиции',
        'length'                => 'Длина груза (см) позиции',
        'volume'                => 'Объем М³ позиции',

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

    //  обязательные поля по условию
    private $dependent = [

        1 => [
            'field' => 'declared_price',
            'depend' => 50000,
            'sing' => '>=',
            'fieldDepend' => 'have_doc'
        ],

        2 => [
            'field' => 'declared_price',
            'depend' => 10000,
            'sing' => '>=',
            'fieldDepend' => 'insurance'
        ],

        3 => [
            'field' => 'insurance',
            'depend' => true,
            'sing' => '=',
            'fieldDepend' => 'insurance_agent_code'
        ]
    ];

    /**
     * Calculate constructor.
     * @param array $params
     * @param bool $volume
     */
    public function __construct(array $params = array(), bool $volume = true)
    {
        parent::__construct($params);

        Validation::checkDependent($this->params, $this->dependent);

        if ($volume) {
            Validation::checkNecessary($this->params, CommandBus::handle(new Volume()));
        } else {
            Validation::checkNecessary($this->params, CommandBus::handle(new Size()));
        }

        $this->params = ArrayHelp::getPlaces($this->params, $volume);
    }

    /**
     * @return mixed
     */
    public function standart()
    {
        return ArrayHelp::calculateResult($this->response, 'standart');
    }

    /**
     * @return mixed
     */
    public function economy()
    {
        return ArrayHelp::calculateResult($this->response, 'economy');
    }

    /**
     * @return mixed
     */
    public function express()
    {
        return ArrayHelp::calculateResult($this->response, 'express');
    }

    /**
     * @return mixed
     */
    public function standard_courier()
    {
        return ArrayHelp::calculateResult($this->response, 'standard_courier');
    }

    /**
     * @return mixed
     */
    public function express_courier()
    {
        return ArrayHelp::calculateResult($this->response, 'express_courier');
    }
}