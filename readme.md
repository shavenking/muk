要解決什麼問題？
- 同支付平台，因接口參數不同造成程式需要額外判斷
- 不同支付平台參數相同，但還是得分開，無法共用

可能實作的方式：把顆粒再切得更細，應該以支付平台的各「接口」為單位，定義出接口的特徵（config），也就是有一套基本通用的流程（使用者可以擴充），新增接口只需要新增設定檔。

```php
// $endpointConfig = DB::getEndpoint('weixin', 'qrcode'); // 使用者可以把設定檔存在任何地方，只需要符合 EndpointConfig 介面就可以
$endpointConfig = new class implements EndpointConfig {
    // endpointConfig 需定義出要使用的流程
    // endpointConfig 定義出所有該接口的特徵
    // 如何定義特徵？
    // public $preMapping = [
    //     'number' => 'mchId',
    //     'orderId' => 'orderId',
    //     'amount' => 'orderAmount'
    // ];
};

// 基本的統一流程
class PaymentGateway
{
    public function createOrder(array $data, EndpointConfigInterface $config)
    {
        return $this->mapData($config->preMapping)
            ->sign($config->signStrategy, $config->signConfig)
            ->send($config->endpoint)
            ->validateResponseSign($config->responseSignStrategy, $config->responseSignParams)
            ->getResponseData()
            ->mapData($config->postMapping);
    }
}

// createOrder 將依照 endpointConfig 定義的流程，及相關設定、特徵執行，最後取得訂單資料（過程中可以會有對外等等的動作）
// $data 的部分預計會讓使用者丟所有的資料進來，流程內所需要的資料都會從 $data 取
$order = PaymentGateway::createOrder($data, $config);

// $order 裡面就會是最後的資料，可供使用者自由運用
// 比方說 $order 可能會有 qrcode 網址、表單的資料、重導網址等等
// $order->hasQrcode(); // return boolean
// $order->qrcode(); // return qrcode string
```
