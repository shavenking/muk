<?php

namespace Muk;

class PaymentGateway
{
    protected $originData;
    protected $targetData;
    protected $response;

    public function createOrder(array $data, GatewayConfig $config)
    {
        $this->originData = $data;
        $mappings = $config->mappings();

        return $this->mapData(array_shift($mappings))
            ->sign($config->signConfig())
            ->mapData(array_shift($mappings))
            ->send($config->endpoint())
            // ->validateResponseSign($config->responseSignStrategy, $config->responseSignParams)
            ->continueWithReponse()
            ->mapData(array_shift($mappings))
            ->finish();
    }

    protected function mapData(MappingConfig $mapping)
    {
        foreach ($mapping->map as $origin => $target) {
            $this->targetData[$target] = $this->originData[$origin];
        }

        return $this;
    }

    protected function sign(SignConfig $config)
    {
        $signData = [];

        foreach ($config->getKeys() as $signedKey) {
            $signData[$signedKey] = $this->targetData[$signedKey];
        }

        foreach ($config->getSignPrepare() as $signPrepare) {
            $signData = $signPrepare->prepare($signData);
        }

        $sign = $signData;

        foreach ($config->getSignStrategy() as $signStrategy) {
            $sign = $signStrategy->sign($sign);
        }

        $this->targetData[$config->targetKey()] = $sign;

        return $this;
    }

    protected function send(Endpoint $endpoint)
    {
        // need a client
        $this->response = curl($endpoint);

        return $this;
    }

    protected function continueWithReponse()
    {
        $this->targetData = $this->response;

        return $this;
    }

    protected function finish()
    {
        return $this->targetData;
    }
}
