<?php

namespace Muk\SignStrategy;

interface SignStrategyInterface
{
    public function sign(string $origin): string;
}
