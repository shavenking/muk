<?php

namespace Muk\Config\Endpoint;

class DefaultEndpoint implements Endpoint
{
    public function __construct(array $config)
    {
        $this->method = $config['method'];
        $this->uri = $config['uri'];
        $this->host = $config['host'];
        $this->contentType = $config['contentType'];
    }
    public function method()
    {
        return $this->method;
    }

    public function uri()
    {
        return $this->uri;
    }

    public function host()
    {
        return $this->host;
    }

    public function contentType()
    {
        return $this->contentType;
    }
}
