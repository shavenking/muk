<?php

namespace Payment\Interface;

interface ISign
{
    public function getKeys();
    public function getSignData();
    public function getSignStrategy();
    public function getSign();
}
