<?php

namespace Muk;

use Muk\Config\Endpoint\Endpoint;
use Muk\Config\SignConfig\SignConfig;

interface GatewayConfig
{
    public function mappings(): array;
    public function signConfig(): SignConfig;
    public function endpoint(): Endpoint;
}
