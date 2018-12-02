<?php

namespace Wstanley\Gtdapi;

use GuzzleHttp\Client;
use Wstanley\Gtdapi\Helpers\StringHelp;

class GtdService
{
    private $client;
    private $gtd_uri = 'https://capi.gtdel.com/1.0/';
    private $kit_uri = 'https://capi.tk-kit.com/2.0/';

    /**
     * Service constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        if (empty(getenv('TOKEN_GTD'))) {
            throw new \Exception('Добавьте токен в файл .env TOKEN_GTD=token');
        }

        $this->client  = new Client(
            [
            'base_uri' => $this->gtd_uri,
            'headers'  => [
                'Accept'        => 'application/json',
                'Authorization' => 'Bearer ' . getenv('TOKEN_GTD'),
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
     *  функция /1.0/order/create
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function create(array $params = array(), bool $volume = true)
    {
        return $this->json(new \Wstanley\Gtdapi\Order\Create($params, $volume));
    }


    /**
     *  функция /1.0/order/calculate
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function calculate(array $params = array(), bool $volume = true)
    {
        return $this->json(new \Wstanley\Gtdapi\Order\Calculate($params, $volume));
    }

    /**
     *  функция /1.0/tdd/city/get-list
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function cityTdd(array $params = array())
    {
        return $this->json(new \Wstanley\Gtdapi\Tdd\City($params));
    }

    /**
     *  функция /1.0/tdd/country/get-list
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function country(array $params = array())
    {
        return $this->json(new \Wstanley\Gtdapi\Tdd\Country($params));
    }

    /**
     *  функция /1.0/tdd/region/get-list
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function Region(array $params = array())
    {
        return $this->json(new \Wstanley\Gtdapi\Tdd\Region($params));
    }

    /**
     *  функция /1.0/order/currency/get-list
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function currency(array $params = array())
    {
        return $this->json(new \Wstanley\Gtdapi\Order\Currency($params));
    }

    /**
     *  функция /1.0/order/insurance/get-list
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function insurance(array $params = array())
    {
        return $this->json(new \Wstanley\Gtdapi\Order\Insurance($params));
    }

    /**
     *  функция /1.0/order/service/get-list
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function service(array $params = array())
    {
        return $this->json(new \Wstanley\Gtdapi\Order\Service($params));
    }

    /**
     *  функция /1.0/order/status/get
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function status(array $params = array())
    {
        return $this->json(new \Wstanley\Gtdapi\Order\Status($params));
    }

    /**
     *  функция /1.0/geography/city/get-list
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function cityGeography(array $params = array())
    {
        return $this->json(new \Wstanley\Gtdapi\Geography\City($params));
    }

    /**
     *  функция /1.0/geography/email/get-list
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function email(array $params = array())
    {
        return $this->json(new \Wstanley\Gtdapi\Geography\Email($params));
    }

    /**
     *  функция /1.0/geography/phone/get-list
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function phone(array $params = array())
    {
        return $this->json(new \Wstanley\Gtdapi\Geography\Phone($params));
    }

    /**
     *  функция /1.0/geography/schedule/get-list
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function schedule(array $params = array())
    {
        return $this->json(new \Wstanley\Gtdapi\Geography\Schedule($params));
    }

    /**
     *  функция /1.0/geography/schedule-group/get-list
     *
     * @param array $params
     * @return FunctionInterface
     */
    public function scheduleGroup(array $params = array())
    {
        return $this->json(new \Wstanley\Gtdapi\Geography\ScheduleGroup($params));
    }
}
