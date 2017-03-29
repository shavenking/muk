<?php

namespace Muk\Config\SignConfig;

interface SignConfig
{
    public function getKeys(): array;
    public function getPrepareStrategy(): array;
    public function getSignStrategy(): array;
    public function targetKey(): string;
}
