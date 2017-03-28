<?php
namespace Tests;

use Payment\Foo;
use PHPUnit\Framework\TestCase;

class FooTest extends TestCase
{
    public function testFooStart()
    {
        $foo = new Foo();

        $this->assertEquals('123', $foo->start());
    }
}
