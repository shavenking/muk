<?php

namespace Muk\Config\SignConfig;

class DefaultSignConfig implements SignConfig
{
    public $keys;
    public $prepareStrategy;
    public $signStrategy;
    public $targetKey;

    public function __construct()
    {
        $this->keys = [];
        $this->prepareStrategy = [];
        $this->signStrategy = [];
        $this->targetKey = '';
    }

    public function getKeys(): array
    {
        return $this->keys;
    }

    public function getPrepareStrategy(): array
    {
        return $this->prepareStrategy;
    }

    public function getSignStrategy(): array
    {
        return $this->signStrategy;
    }

    public function targetKey(): string
    {
        return $this->targetKey;
    }
}
