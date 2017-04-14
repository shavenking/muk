<?php

namespace Muk\Step;

interface StepInterface
{
    public function execute(array $origin): array;
}
