<?php

namespace Tests;

use Muk\{
    PaymentGateway,
    PaymentGatewayConfigInterface
};
use PHPUnit\Framework\TestCase;

class PaymentGatewayTest extends TestCase
{
    public function testCreateOrder()
    {
        // fetch config from any place
        // $config = DB::fetch(...);

        if (!($config instanceof PaymentGatewayConfigInterface)) {
            $this->fails();
        }

        $order = PaymentGateway::with($config)->createOrder([
            // original data
            'merchant_number' => '123',
            'order_id' => '9487',
            'order_amount' => '0.01',
            'order_date' => '2017-01-01',
            'username' => 'user1',
            'ip' => '192.168.0.1',
            'notify_url' => 'http://google.com/notify',
            'merchant_extra' => [
                'cmp_app_id' => '456'
            ]
        ]);

        $this->assertSame($order->toArray(), [
            // final data for payment gateway
            'version' => '1.0.0',
            'encoding' => 'UTF-8',
            'signature' => 'qowiejq01293joqiwejxoiq=1239',
            'mchId' => '123',
            'cmpAppId' => '456',
            'payTypeCode' => 'web.pay',
            'outTradeNo' => '9487',
            'tradeTime' => '20170101',
            'amount' => '1',
            'summary' => 'user1',
            'deviceIp' => '192.168.0.1',
            'returnUrl' => 'http://google.com/notify'
        ]);
    }
}
