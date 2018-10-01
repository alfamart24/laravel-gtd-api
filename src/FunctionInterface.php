<?php

namespace Wstanley\Kitapi;

interface FunctionInterface
{
    /**
     *  возвращаем uri нашей функции
     *
     * @return mixed
     */
    public function uri();

    /**
     *  получение заполненых параметров
     *  для отправки на api
     *
     * @return mixed
     */
    public function params();

    /**
     *  возврат всего ответа от сервера
     *
     * @return mixed
     */
    public function all();

    /**
     *  записываем ответ в поле response
     *
     * @param $data
     * @return mixed
     */
    public function setResponse($data);
}