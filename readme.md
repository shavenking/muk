## Usage

You can push any step into process, idealy you can organize any process with steps, for example, process for creating an order, process for quering existing order, process for verify order status, etc.

Create an order:

```php
$process = new Process;

// new order
$order = $process
    ->push(new Step\MapData(new Mapping\Mappping([/* mapping */])));
    ->push(new Step\Sign('target_key', [new SignStrategy\HttpBuildQuery, new SignStrategy\UrlDecode, new SignStrategy\Md5]))
    ->execute($originData);
```

Query existing order:

```php
$process = new Process;

// order status
$status = $process
    ->push(new Step\MapData(new Mapping\Mapping([/* mapping */])));
    ->push(new Step\Send(new Endpoint\Endpoint($endpointConfig)))
    ->execute($originData);
```

## What's next step?

- [ ] Provide default process that has all steps needed in common payment gateway usage
