<?php

namespace Muk;

class Process implements ProcessInterface
{
    public function __construct()
    {
        $this->steps = [];
    }

    public function push(StepInterface $step)
    {
        array_push($this->steps, $step);

        return $this;
    }

    public function execute(array $origin)
    {
        foreach ($this->steps as $step) {
           $origin = $step->execute($origin);
        }

        return $origin;
    }
}
