<?php

namespace Wstanley\Kitapi\Helpers;

class ArrayHelp
{
    /**
     *  преобразует данные о местах и позициях
     *  в нужный вид
     *
     * @param $params
     * @return mixed
     */
    public static function getPlaces($params)
    {

        for ($i=0;$i<count($params['count_place']);$i++) {

            $params['places'][$i]['count_place'] = $params['count_place'][$i];
            $params['places'][$i]['weight']      = $params['weight'][$i];
            $params['places'][$i]['height']      = $params['height'][$i];
            $params['places'][$i]['width']       = $params['width'][$i];
            $params['places'][$i]['length']      = $params['length'][$i];
        }

        unset($params['count_place'], $params['weight'],
            $params['height'], $params['width'], $params['length']);

        return $params;
    }

    /**
     *  проверяем есть ли запрашиваемое поле
     *  в ответе от сервера и возвращаем его
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