<?php

namespace Muk\Step;

use Muk\Mapping\MappingInterface;

class MapData implements StepInterface
{
    public function __construct(MappingInterface $mapping)
    {
        $this->mapping = $mapping;
    }

    public function execute(array $origin): array
    {
        return $this->mapping->map($origin);
    }
}
