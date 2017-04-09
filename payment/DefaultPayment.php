<?php

namespace Payment;

class DefaultPayment extends DefaultPaymentType
{
    public function __contruct()
    {
        echo $this->getForm();
    }
}
