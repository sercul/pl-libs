<?php

use DTS\eBaySDK\Trading\Types\LocalMarketNonSubscriptionDefinitionType;

class LocalMarketNonSubscriptionDefinitionTypeTest extends \PHPUnit_Framework_TestCase
{
    private $obj;

    protected function setUp()
    {
        $this->obj = new LocalMarketNonSubscriptionDefinitionType();
    }

    public function testCanBeCreated()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\Trading\Types\LocalMarketNonSubscriptionDefinitionType', $this->obj);
    }

    public function testExtendsBaseType()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\Types\BaseType', $this->obj);
    }
}
