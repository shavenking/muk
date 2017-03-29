<?php

namespace Muk\Config\Mapping;

class DefaultMapping implements MappingConfig
{
    protected $map;

    public function __construct(array $map)
    {
        $this->map = $map;
    }

    public function map()
    {
        return $this->map;
    }
}
