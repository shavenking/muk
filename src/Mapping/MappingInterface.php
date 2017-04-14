<?php

namespace Muk\Mapping;

interface MappingInterface
{
    public function map(array $origin): array;
}
