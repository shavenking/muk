<?php

namespace Muk\Step;

use Muk\SignStrategy\SignStrategyInterface;

class Sign implements StepInterface
{
    public function __construct(string $targetKey, array $strategies)
    {
        $this->targetKey = $targetKey;
        $this->strategies = $strategies;
    }

    public function execute(array $origin): array
    {
        $value = $origin[$this->targetKey] ?: '';

        if (!is_string($value)) {
            throw new \Exception('Here should throw exception');
        }

        foreach ($this->strategies as $strategy) {
            if (!($strategy instanceof SignStrategyInterface)) {
                throw new \Exception('Here should throw exception');
            }

            $value = $strategy->sign($value);
        }

        $origin[$this->targetKey] = $value;

        return $origin;
    }
}
