<?php

namespace Webadvance\Kitapiv2;

use GuzzleHttp\Client;
use Webadvance\Kitapiv2\Geography\Email;
use Webadvance\Kitapiv2\Geography\Phone;
use Webadvance\Kitapiv2\Geography\Schedule;
use Webadvance\Kitapiv2\Geography\ScheduleGroup;
use Webadvance\Kitapiv2\helpers\StringHelp;
use Webadvance\Kitapiv2\Order\Calculate;
use Webadvance\Kitapiv2\Order\Currency;
use Webadvance\Kitapiv2\Order\Insurance;
use Webadvance\Kitapiv2\Order\Service;
use Webadvance\Kitapiv2\Order\Status;
use Webadvance\Kitapiv2\Tdd\City;
use Webadvance\Kitapiv2\Tdd\Country;
use Webadvance\Kitapiv2\Tdd\Region;

class KitService
{
    private $client;
    private $base_uri = 'https://capi.tk-kit.com/2.0/';

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

    public function cityTdd(array $params = array())
    {
        return $this->post(new City($params));
    }

    public function country(array $params = array())
    {
        return $this->post(new Country($params));
    }

    public function Region(array $params = array())
    {
        return $this->post(new Region($params));
    }

    public function currency(array $params = array())
    {
        return $this->post(new Currency($params));
    }

    public function insurance(array $params = array())
    {
        return $this->post(new Insurance($params));
    }

    public function calculate(array $params = array())
    {
        return $this->post(new Calculate($params));
    }

    public function service(array $params = array())
    {
        return $this->post(new Service($params));
    }

    public function status(array $params = array())
    {
        return $this->post(new Status($params));
    }

    public function cityGeography(array $params = array())
    {
        return $this->post(new \Webadvance\Kitapiv2\Geography\City($params));
    }

    public function email(array $params = array())
    {
        return $this->post(new Email($params));
    }

    public function phone(array $params = array())
    {
        return $this->post(new Phone($params));
    }

    public function schedule(array $params = array())
    {
        return $this->post(new Schedule($params));
    }

    public function scheduleGroup(array $params = array())
    {
        return $this->post(new ScheduleGroup($params));
    }
}