<?php

namespace Muk\Config\SignConfig\SignPrepare;

class UrlDecodeSignPrepare implements SignPrepare
{
    public function prepare($data)
    {
        return urldecode($data);
    }
}
