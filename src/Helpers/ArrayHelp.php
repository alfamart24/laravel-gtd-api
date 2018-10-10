<?php

namespace Wstanley\Kitapi\Helpers;

class ArrayHelp
{
    /**
     *  Преобразует данные о местах и позициях в нужный вид
     *
     * @param $params
     * @return mixed
     */
    public static function getPlaces($params, bool $volume = true)
    {
        for ($i=0;$i<count($params['count_place']);$i++) {

            $params['places'][$i]['count_place'] = $params['count_place'][$i];
            $params['places'][$i]['weight']      = $params['weight'][$i];

            if ($volume) {

                $params['places'][$i]['volume']      = $params['volume'][$i];
            } else {

                $params['places'][$i]['height']      = $params['height'][$i];
                $params['places'][$i]['width']       = $params['width'][$i];
                $params['places'][$i]['length']      = $params['length'][$i];
            }
        }

        unset($params['count_place'], $params['weight'], $params['height'],
            $params['width'], $params['length'], $params['volume']);

        return $params;
    }

    /**
     *  Приводим параметры к нужному виду
     *  Избавляемся от массивов
     *
     * @param $params
     * @param $name
     * @return mixed
     */
    public static function getParams($params, $name)
    {
        array_filter($params[$name],
            function ($value, $key) use (&$params)
                { $params[$key] = $value; }, ARRAY_FILTER_USE_BOTH);

        $params[$name] = 1;

        return $params;
    }

    /**
     *  Проверяем есть ли запрашиваемое поле в ответе от сервера и возвращаем его
     *
     * @param $data
     * @param $type
     * @return mixed
     * @throws \Exception
     */
    public static function calculateResult($data, $type)
    {
        foreach ($data as $result) {

            if (key($result) == $type) {

                return $result->$type;
            }
            $key = key($result);
        }
        $key = isset($key) ? $key : 'другой';

        throw new \Exception(sprintf('метода %s в ответе не было, попробуйте %s', $type, $key));
    }
}