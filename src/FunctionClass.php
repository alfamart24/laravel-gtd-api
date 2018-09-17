<?php

namespace Webadvance\Kitapiv2;

use Webadvance\Kitapiv2\Helpers\Validation;

abstract class FunctionClass implements FunctionInterface
{
    protected $response;

    protected $uri;

    protected $params = [];

    protected $optional = [];

    protected $necessary = [];

    public function __construct(array $params = array())
    {
        $this->params = $params;

        unset($this->params['_token']);

        Validation::checkParams($this->params, $this->necessary, $this->optional);

        if (!empty($this->necessary)) Validation::checkNecessary($this->params, $this->necessary);
    }

    public function uri()
    {
        return $this->uri;
    }

    public function params()
    {
        return $this->params;
    }

    public function all()
    {
        return $this->response;
    }

    public function setResponse($data)
    {
        $this->response = $data;
    }
}