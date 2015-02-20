<?php

use DTS\eBaySDK\Trading\Types\EBayMotorsProContactByAddressEnabledDefinitionType;

class EBayMotorsProContactByAddressEnabledDefinitionTypeTest extends \PHPUnit_Framework_TestCase
{
    private $obj;

    protected function setUp()
    {
        $this->obj = new EBayMotorsProContactByAddressEnabledDefinitionType();
    }

    public function testCanBeCreated()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\Trading\Types\EBayMotorsProContactByAddressEnabledDefinitionType', $this->obj);
    }

    public function testExtendsBaseType()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\Types\BaseType', $this->obj);
    }
}
