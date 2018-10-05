<?php

namespace Wstanley\Kitapi;

use GuzzleHttp\Client;
use Wstanley\Kitapi\helpers\StringHelp;

class KitService
{
    private $client;
    private $base_uri = 'https://capi.tk-kit.com/2.0/';

    /**
     * KitService constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        if (empty(getenv('TOKEN_KIT'))) {

            throw new \Exception('Добавьте токен в файл .env TOKEN_KIT=token');
        }

        $this->client  = new Client(
            [
            'base_uri' => $this->base_uri,
            'headers'  => [
                'Accept'        => 'application/json',
                'Authorization' => 'Bearer ' . getenv('TOKEN_KIT'),
            ],
        ]);
    }

    /**
     *  отправка запроса методом пост
     *
     * @param FunctionInterface $function
     * @return FunctionInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function post(FunctionInterface $function)
    {
        $content = $this->client->request('POST', $function->uri(),
            [
                'form_params' => $function->params(),
            ]
        )->getBody()->getContents();

        $content = StringHelp::checkC($content);

        $function->setResponse(json_decode($content));

        return $function;
    }

    /**
     *  отправка запроса методом json
     *
     * @param FunctionInterface $function
     * @return FunctionInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function json(FunctionInterface $function)
    {
        $content = $this->client->request('PUT', $function->uri(),
            [
                'json' => $function->params(),
            ]
        )->getBody()->getContents();

        $content = StringHelp::checkC($content);

        $function->setResponse(json_decode($content));

        return $function;
    }

    /**
     *  функция /2.0/order/create
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function create(array $params = array(), bool $volume = true)
    {
        return $this->post(new \Wstanley\Kitapi\Order\Create($params, $volume));
    }


    /**
     *  функция /2.0/order/calculate
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function calculate(array $params = array(), bool $volume = true)
    {
        return $this->post(new \Wstanley\Kitapi\Order\Calculate($params, $volume));
    }

    /**
     *  функция /2.0/tdd/city/get-list
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function cityTdd(array $params = array())
    {
        return $this->post(new \Wstanley\Kitapi\Tdd\City($params));
    }

    /**
     *  функция /2.0/tdd/country/get-list
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function country(array $params = array())
    {
        return $this->post(new \Wstanley\Kitapi\Tdd\Country($params));
    }

    /**
     *  функция /2.0/tdd/region/get-list
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function Region(array $params = array())
    {
        return $this->post(new \Wstanley\Kitapi\Tdd\Region($params));
    }

    /**
     *  функция /2.0/order/currency/get-list
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function currency(array $params = array())
    {
        return $this->post(new \Wstanley\Kitapi\Order\Currency($params));
    }

    /**
     *  функция /2.0/order/insurance/get-list
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function insurance(array $params = array())
    {
        return $this->post(new \Wstanley\Kitapi\Order\Insurance($params));
    }

    /**
     *  функция /2.0/order/service/get-list
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function service(array $params = array())
    {
        return $this->post(new \Wstanley\Kitapi\Order\Service($params));
    }

    /**
     *  функция /2.0/order/status/get
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function status(array $params = array())
    {
        return $this->post(new \Wstanley\Kitapi\Order\Status($params));
    }

    /**
     *  функция /2.0/geography/city/get-list
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function cityGeography(array $params = array())
    {
        return $this->post(new \Wstanley\Kitapi\Geography\City($params));
    }

    /**
     *  функция /2.0/geography/email/get-list
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function email(array $params = array())
    {
        return $this->post(new \Wstanley\Kitapi\Geography\Email($params));
    }

    /**
     *  функция /2.0/geography/phone/get-list
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function phone(array $params = array())
    {
        return $this->post(new \Wstanley\Kitapi\Geography\Phone($params));
    }

    /**
     *  функция /2.0/geography/schedule/get-list
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function schedule(array $params = array())
    {
        return $this->post(new \Wstanley\Kitapi\Geography\Schedule($params));
    }

    /**
     *  функция /2.0/geography/schedule-group/get-list
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function scheduleGroup(array $params = array())
    {
        return $this->post(new \Wstanley\Kitapi\Geography\ScheduleGroup($params));
    }
}