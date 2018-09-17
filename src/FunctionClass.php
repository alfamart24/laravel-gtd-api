<?php

namespace Webadvance\Kitapiv2;

use Webadvance\Kitapiv2\Helpers\Validation;

abstract class FunctionClass implements FunctionInterface
{
    // храним ответ от сервера
    protected $response;

    //  храним uri текущей функции
    protected $uri;

    //  храним переданные параметры
    protected $params = [];

    //  список не обязательных параметров функции
    protected $optional = [];

    //  список обязательных параметров функции
    protected $necessary = [];

    public function __construct(array $params = array())
    {
        $this->params = $params;

        //  удаляем лишнее поле
        unset($this->params['_token']);

        //  проверяем нет ли лишних параметров
        Validation::checkParams($this->params, $this->necessary, $this->optional);

        //  проверяем все ли обязательные поля пришли
        if (!empty($this->necessary)) Validation::checkNecessary($this->params, $this->necessary);
    }

    /**
     *  возврат текущего uri функции
     *
     * @return mixed
     */
    public function uri()
    {
        return $this->uri;
    }

    /**
     *  получение переданных параметров текущей функции
     *
     * @return array
     */
    public function params()
    {
        return $this->params;
    }

    /**
     *  возвращает весь ответ от сервера
     *
     * @return mixed
     */
    public function all()
    {
        return $this->response;
    }

    /**
     *  сохраняем весь ответ от сервера
     *
     * @param $data
     */
    public function setResponse($data)
    {
        $this->response = $data;
    }
}