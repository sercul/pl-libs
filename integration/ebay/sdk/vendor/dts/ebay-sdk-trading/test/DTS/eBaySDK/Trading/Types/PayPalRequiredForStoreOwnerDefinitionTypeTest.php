<?php

use DTS\eBaySDK\Trading\Types\PayPalRequiredForStoreOwnerDefinitionType;

class PayPalRequiredForStoreOwnerDefinitionTypeTest extends \PHPUnit_Framework_TestCase
{
    private $obj;

    protected function setUp()
    {
        $this->obj = new PayPalRequiredForStoreOwnerDefinitionType();
    }

    public function testCanBeCreated()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\Trading\Types\PayPalRequiredForStoreOwnerDefinitionType', $this->obj);
    }

    public function testExtendsBaseType()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\Types\BaseType', $this->obj);
    }
}
