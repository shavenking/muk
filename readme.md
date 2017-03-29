要解決什麼問題？
- 同支付平台，因接口參數不同造成程式需要額外判斷
- 不同支付平台參數相同，但還是得分開，無法共用

可能實作的方式：把顆粒再切得更細，應該以支付平台的各「接口」為單位，定義出接口的特徵（config），也就是有一套基本通用的流程（使用者可以擴充），新增接口只需要新增設定檔。

```php
// 使用者可以把設定檔存在任何地方，只需要符合 GatewayConfig 介面就可以
$config = new \Muk\DefaultGatewayConfig;

array_push($config->mappings, new \Muk\Config\Mapping\DefaultMapping([
    'number' => 'mchId',
    'orderId' => 'outTradeNo',
    'orderCreateDate' => 'tradeTime',
    'amount' => 'amount',
    'username' => 'summary',
    'ip' => 'deviceIp',
    'notify_url' => 'returnUrl'
]));

// push empty mapping and do nothing
array_push($config->mappings, new \Muk\Config\Mapping\DefaultMapping([]));

// final mapping
array_push(
    $config->mappings,
    new \Muk\Config\Mapping\DefaultMapping([/* some data */])
);

$signConfig = new \Muk\Config\SignConfig\DefaultSignConfig;
$signConfig->keys = [
    'version', 'encoding', 'mchId', 'cmpAppId',
    'payTypeCode', 'outTradeNo', 'tradeTime', 'amount',
    'summary', 'deviceIp', 'returnUrl'
];
$signConfig->prepareStrategy = [
    new \Muk\Config\SignConfig\SignPrepare\HttpBuildQuerySignPrepare::class,
    new \Muk\Config\SignConfig\SignPrepare\UrlDecodeSignPrepare::class
];
$signConfig->signStrategy = [new \Muk\Config\SignConfig\SignStrategy\OpensslSignStrategy];
$signConfig->targetKey = 'signature';

$config->signConfig = $signConfig;

$endpoint = new \Muk\Config\Endpoint\DefaultEndpoint([
    'method' => 'post',
    'uri' => '/order/add',
    'host' => 'payment.xyz.com.tw',
    'contentType' => 'application/x-form-urlencoded'
]);

$config->endpoint = $endpoint;

// $data 的部分預計會讓使用者丟所有的資料進來，流程內所需要的資料都會從 $data 取
$order = PaymentGateway::createOrder([/* ... */], $config);

// $order 裡面就會是最後的資料，可供使用者自由運用
// 比方說 $order 可能會有 qrcode 網址、表單的資料、重導網址等等
// $order->hasQrcode(); // return boolean
// $order->qrcode(); // return qrcode string
```
