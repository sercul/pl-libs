<?php

use DTS\eBaySDK\Trading\Types\MaximumBuyerPolicyViolationsType;

class MaximumBuyerPolicyViolationsTypeTest extends \PHPUnit_Framework_TestCase
{
    private $obj;

    protected function setUp()
    {
        $this->obj = new MaximumBuyerPolicyViolationsType();
    }

    public function testCanBeCreated()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\Trading\Types\MaximumBuyerPolicyViolationsType', $this->obj);
    }

    public function testExtendsBaseType()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\Types\BaseType', $this->obj);
    }
}
