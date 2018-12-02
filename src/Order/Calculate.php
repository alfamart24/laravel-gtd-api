<?php

namespace Wstanley\Gtdapi\Order;

use Wstanley\Gtdapi\Command\Places\Size;
use Wstanley\Gtdapi\Command\Places\Volume;
use Wstanley\Gtdapi\FunctionClass;
use Wstanley\Gtdapi\Helpers\ArrayHelp;
use Wstanley\Gtdapi\Helpers\Validation;

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

    private $standart;
    private $economy;
    private $express;
    private $standard_courier;
    private $express_courier;
    public $error;

    /**
     *  Вся логика валидации находится здесь
     *
     *  Функция отправляет данные либо с посчитанным объемом либо с размерами
     *  подробнее смотри в документации к апи
     *  $volume = true - поумолчанию функция ожидает объем
     *  для отправки данных с размерами требуется передать $volume = false
     *
     * Calculate constructor.
     * @param array $params
     * @param bool $volume
     */
    public function __construct(array $params = array(), bool $volume = true)
    {
        parent::__construct($params);

        Validation::checkDependent($this->params, $this->dependent);

        if ($volume) {
            Validation::checkNecessary($this->params, Volume::necessary());
        } else {
            Validation::checkNecessary($this->params, Size::necessary());
        }

        //  если выбраны "дополнительные услуги" приводим их к нужному виду
        if (isset($this->params['service'])) {
            $this->params = ArrayHelp::getService($this->params);
        }

        //  приводим "места" в нужный вид перед отправкой
        $this->params = ArrayHelp::getPlaces($this->params, $volume);
    }

    /**
     *  Заполняем поля класса ответом от сервера
     *  Либо заполняется ошибка $this->error = 'Ошибка расчета'
     *
     * @return $this
     */
    public function calculateResult()
    {
        if (!is_array($this->response)) {
            $this->error = 'Ошибка расчета';
            return $this;
        }
        array_filter($this->response, function ($value, $key) {
            foreach (get_class_vars(get_class($this)) as $key => $valueClass) {
                if ($key == key($value)) {$this->$key = $value->$key;}}
        }, ARRAY_FILTER_USE_BOTH);

        return $this;
    }

    /**
     *  Получение адреса терминада доставки
     *  требуется для оформления ордера
     *
     * @param $name
     * @return bool
     */
    public function dispatch_address($name)
    {
        return isset($this->$name->dispatch_address[0]) ? $this->$name->dispatch_address[0] : false;
    }

    /**
     *  Получение цены расчета
     *
     * @param $name
     * @return string
     */
    public function cost($name)
    {
        return isset($this->$name()->cost)
            ? $this->$name()->cost : 'Ошибка расчета'; // sprintf('Цены в методе %s нет', $name);
    }

    /**
     * @return mixed
     */
    public function standart()
    {
        return isset($this->standart) ? $this->standart : false;
    }

    /**
     * @return mixed
     */
    public function economy()
    {
        return isset($this->economy) ? $this->economy : false;
    }

    /**
     * @return mixed
     */
    public function express()
    {
        return isset($this->express) ? $this->express : false;
    }

    /**
     * @return mixed
     */
    public function standard_courier()
    {
        return isset($this->standard_courier) ? $this->standard_courier : false;
    }

    /**
     * @return mixed
     */
    public function express_courier()
    {
        return isset($this->express_courier) ? $this->express_courier : false;
    }
}
