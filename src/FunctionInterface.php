<?php

namespace Webadvance\Kitapiv2;


interface FunctionInterface
{
    public function uri();
    public function params();
    public function all();
    public function setResponse($data);
}