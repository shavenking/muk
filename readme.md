Usage

```php
$process = new Process;

$process->push(new Step\MapData, new Mappping([]));
$process->push(new Step\Sign, [new Sign\HttpBuildQuery, new Sign\UrlDecode, new Sign\Md5]);

$order = PaymentGateway::with($process)->createOrder($someKindOfOriginData);

$this->assertInstanceOf(Order::class, $order);

$order->toArray();
```

We also provide a default `Process`.

Config should be serializable in order to store in database.
