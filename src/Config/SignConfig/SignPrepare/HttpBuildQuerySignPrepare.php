<?php

namespace Muk\Config\SignConfig\SignPrepare;

class HttpBuildQuerySignPrepare implements SignPrepare
{
    public function prepare($data)
    {
        return http_build_query($data);
    }
}
