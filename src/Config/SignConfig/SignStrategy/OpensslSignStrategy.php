<?php

namespace Muk\Config\SignConfig\SignStrategy;

class OpensslSignStrategy implements SignStrategy
{
    public function sign($data)
    {
        openssl_sign($data, $sign, $this->privateKey);

        return $sign;
    }
}
