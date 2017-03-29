<?php

namespace Muk\Config\SignConfig\SignStrategy;

interface SignStrategy
{
    public function sign($data);
}
