<?php

namespace Muk;

class DefaultGatewayConfig implements GatewayConfig
{
    public $mappings;

    public $signConfig;

    public $endpoint;

    public function __construct()
    {
        $this->mappings = [];
    }

    public function mappings(): array
    {
        return $this->mappings;
    }

    public function signConfig(): SignConfig
    {
        return $this-signConfig;
    }

    public function endpoint(): Endpoint
    {
        return $this->endpoint;
    }
}
