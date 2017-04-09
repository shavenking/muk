<?php

namespace Payment\Abstract;

abstract DefaultPaymentType.php implements IData, ISign, IMap,IForm
{
    protected $rawData;

    public function __construct($configFile)
    {
        $this->rawData = file($configFile);
    }

    public function getSection($section)
    {
        return $this->rawData[$section];
    }

    public function getKey()
    {
        return $this->getSection('key');
    }

    public function getSignData()
    {
        return $this->getSection('signData');
    }

    public function getSignStrategy($data)
    {
        return http_build_query(ksort($data));
    }

    public function getSign()
    {
        return md5($this->getSignStrategy($this->getSignData) . $this->getKey());
    }

    public function db2form()
    {
        $cols = $tihs->getSection('col');
        for ($i = 0, $i < count($cols), $i++) {
            $mapping[$cols[$i]] = $cols[$i+1];
        }

        return $mapping;
    }

    public function getFormData($sign)
    {
        $form =  $this->getSection('form');
        $form[$sign] = $this->getSign();

        return $form;
    }

    public function getForm()
    {
        $form = '<form method="' . $this->getSection('method') . '" action="' . $this->getSection('action_url') . '">';
        foreach ($this->db2form() as $key => $value) {
            $form .= '<input type="hidden" name="' . $key . '" value="' . $this->getFormdata()[$value]  . ">';
        }
        $form .= '<input type="submit" value="submit">';
        $form .= '<\form>';

        return $form;
    }
}
