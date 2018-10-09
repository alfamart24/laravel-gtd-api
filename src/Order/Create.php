<?php

namespace Wstanley\Kitapi\Order;

use Wstanley\Kitapi\Command\Debitor\Individual;
use Wstanley\Kitapi\Command\Debitor\Legal;
use Wstanley\Kitapi\Command\Debitor\Physical;
use Wstanley\Kitapi\Command\Deliver;
use Wstanley\Kitapi\Command\Pickup;
use Wstanley\Kitapi\Command\Places\Volume;
use Wstanley\Kitapi\Command\Places\Size;
use Wstanley\Kitapi\Helpers\Validation;
use Wstanley\Kitapi\Helpers\ArrayHelp;
use Wstanley\Kitapi\FunctionClass;

class Create extends FunctionClass
{
    protected $uri = 'order/create';

    protected $necessary = [

        'city_pickup_code'   => 'Код города откуда',
        'city_delivery_code' => 'Код города куда',
        'type'               => 'Вид перевозки',
        'declared_price'     => 'Объявленная стоимость груза (руб)',

        'customer'           => 'Заказчик (Debitor)',
        'sender'             => 'Отправитель (Debitor)',
        'receiver'           => 'Получатель (Debitor)',

        'count_place'        => 'Количество мест в позиции',
        'weight'             => 'Масса КГ позиции',

//        'debitor_type'     => 'Код города откуда (1-физик, 2-ип, 3-юрик)',
//        'debitor'          => 'Номер дебитора',
    ];

    protected $optional = [

        'cargo_type_code'   => 'Код характера груза',
        'service'           => 'Массив кодов услуг',
        'confirmation_price'=> 'Наличие документов подтверждающих стоимость',

        'height'            => 'Высота груза (см) позиции',
        'width'             => 'Ширина груза (см) позиции',
        'length'            => 'Длина груза (см) позиции',
        'volume'            => 'Объем М³ позиции',

        'pick_up'           => 'Забор груза (Pickup)',

        'deliver'           => 'Доставка груза по городу (Deliver)',

        'insurance'             => 'Услуга страхования груза',
        'insurance_agent_code'  => 'Код страхового агента',
        'have_doc'              => 'Есть документы подтверждающие стоимость груза',

        'currency_code'         => 'Валюта результата расчета',
        'dispatch_address_code' => 'Адрес терминала отправки',
        'all_places_same'       => 'Все места одинаковы по размеру',

        'additional_payment_shipping'   => 'Плательщик перевозки',
        'additional_payment_pickup'     => 'Плательщик забора груза',
        'additional_payment_shipping-?' => 'Плательщик доставки груза',
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
            'field'         => 'insurance',
            'depend'        => true,
            'sing'          => '=',
            'fieldDepend'   => 'insurance_agent_code'
        ],

        4 => [
            'field'         => 'pick_up',
            'depend'        => false,
            'sing'          => '=',
            'fieldDepend'   => 'dispatch_address_code'
        ],
    ];

    public function __construct(array $params = array(), bool $volume = true)
    {
        parent::__construct($params);




        //todo доделать работу с зависимостями


        Validation::checkDependent($this->params, $this->dependent);




        //todo проверить debitor pick_up deliver что это массив


        $this->checkDebitor($this->params['customer']);
        $this->checkDebitor($this->params['sender']);
        $this->checkDebitor($this->params['receiver']);

        if (isset($this->params['pick_up']) && $this->params['pick_up']) {

            Validation::checkNecessary($this->params['pick_up'], Pickup::necessary());
            Validation::checkDependent($this->params['pick_up'], Pickup::dependent());
            Validation::checkParams($this->params['pick_up'], Pickup::necessary(), Pickup::optional());
        }

        if (isset($this->params['deliver']) && $this->params['deliver']) {

            Validation::checkNecessary($this->params['deliver'], Deliver::necessary());
            Validation::checkDependent($this->params['deliver'], Deliver::dependent());
            Validation::checkParams($this->params['deliver'], Deliver::necessary(), Deliver::optional());
        }

        if ($volume) {
            Validation::checkNecessary($this->params, Volume::necessary());
        } else {
            Validation::checkNecessary($this->params, Size::necessary());
        }

        $this->params = ArrayHelp::getPlaces($this->params, $volume);
    }

    private function checkDebitor($debitor)
    {
        switch ($debitor['debitor_type']) {

            case '1' :
                Validation::checkNecessary($debitor, Physical::necessary());
                Validation::checkDependent($debitor, Physical::dependent());
                Validation::checkParams($debitor, Individual::necessary(), Individual::optional());
                break;

            case '2' :
                Validation::checkNecessary($debitor, Individual::necessary());
                Validation::checkDependent($debitor, Individual::dependent());
                Validation::checkParams($debitor, Individual::necessary(), Individual::optional());
                break;

            case '3' :
                Validation::checkNecessary($debitor, Legal::necessary());
                Validation::checkDependent($debitor, Legal::dependent());
                Validation::checkParams($debitor, Individual::necessary(), Individual::optional());
                break;

            default :
                throw new \Exception(
                    sprintf("параметр 'debitor_type' должен быть равен 1 - физик, 2 - ИП, 3 - Юр.лицо"));
                break;
        }
    }
}