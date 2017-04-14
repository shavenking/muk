<?php

namespace Muk;

use Muk\Step\StepInterface;

interface ProcessInterface
{
    public function push(StepInterface $step): ProcessInterface;
    public function execute(array $origin);
}
