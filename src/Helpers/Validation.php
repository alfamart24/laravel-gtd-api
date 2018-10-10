<?php

namespace Wstanley\Kitapi\Helpers;

class Validation
{
    /**
     *  Проверяем нет ли лишних параметров
     *  Проверка идет по ключам массива
     *
     * @param $params       // массив который нужно проверить
     * @param $necessary    // массив с обязательными полями
     * @param $optional     // массив с необязательными полями
     * @throws \Exception
     */
    public static function checkParams($params, $necessary, $optional)
    {
        array_filter($params, function ($key) use ($necessary, $optional) {

            if ((!array_key_exists($key, $necessary) && !array_key_exists($key, $optional))) {

                throw new \Exception('передан не существующий параметр - ' . $key);
            }
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     *  Проверяем все ли обязательные поля пришли
     *  Проверка идет по ключам массива
     *
     * @param $params       // массив который нужно проверить
     * @param $necessary    // массив с обязательными полями
     * @throws \Exception
     */
    public static function checkNecessary($params, $necessary)
    {
        array_filter($necessary, function ($key) use ($params, $necessary) {

            if (!array_key_exists($key, $params)) {

                throw new \Exception('не переданы все обязательные параметры necessary - '
                    . $necessary[$key] . ' (' . $key . ')');
            }
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     *  Проверяем зависимости полей
     *  Можете добавить свои зависимости
     *  Следите за тем что checkNecessary() проверяет массив по ключам
     *
     * @param $params
     * @param $dependent
     * @throws \Exception
     */
    public static function checkDependent($params, $dependent)
    {
        array_filter($dependent, function ($rule) use ($params) {

            switch ($rule['sing']) {

                case '>=' :

                    if (isset($params[$rule['field']]) && $params[$rule['field']] >= $rule['depend']) {

                        self::checkNecessary($params, is_array($rule['fieldDepend'])
                            ? $rule['fieldDepend'] : [$rule['fieldDepend'] => 'стал обязательный по условию']);
                    }
                    break;

                case '>' :

                    if (isset($params[$rule['field']]) && $params[$rule['field']] > $rule['depend']) {

                        self::checkNecessary($params, is_array($rule['fieldDepend'])
                            ? $rule['fieldDepend'] : [$rule['fieldDepend'] => 'стал обязательный по условию']);
                    }
                    break;

                case '=' :

//                    dd($rule['field']);

                    if (isset($params[$rule['field']]) && $params[$rule['field']] == $rule['depend']) {

                        self::checkNecessary($params, is_array($rule['fieldDepend'])
                            ? $rule['fieldDepend'] : [$rule['fieldDepend'] => 'стал обязательный по условию']);
                    }
                    break;

                default :
                    throw new \Exception('не найден знак зависимости $sing ' . $rule);
                    break;
            }
        });
    }

    /**
     *  Проверяем массив ли передали
     *
     * @param $array
     * @param $name
     * @throws \Exception
     */
    public static function isArray($array, $name)
    {
        if (!is_array($array)) {
            throw new \Exception('параметр ' . $name . ' должен быть массивом');
        }
    }
}