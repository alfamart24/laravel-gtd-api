<?php

namespace Wstanley\Kitapi\Helpers;

class Validation
{
    /**
     *  проверяем нет ли лишних параметров
     *
     * @param $params
     * @param $necessary
     * @param $optional
     */
    public static function checkParams($params, $necessary, $optional)
    {
        array_filter($params, function ($key) use ($necessary, $optional) {

            if ((!array_key_exists($key, $necessary) && !array_key_exists($key, $optional))) {

                throw new \Exception('передан не существующий параметр');
            }
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     *  проверяем все ли обязательные поля пришли
     *
     * @param $params
     * @param $necessary
     */
    public static function checkNecessary($params, $necessary)
    {
        array_filter($necessary, function ($key) use ($params) {

            if (!array_key_exists($key, $params)) {

                throw new \Exception('не переданы все обязательные параметры necessary ' . $key);
            }
        }, ARRAY_FILTER_USE_KEY);
    }
}