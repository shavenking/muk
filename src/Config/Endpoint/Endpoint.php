<?php

namespace Muk\Config\Endpoint;

interface Endpoint
{
    public function method();
    public function uri();
    public function host();
    public function contentType();
}
