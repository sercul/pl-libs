<?php

use DTS\eBaySDK\Shopping\Types\FindProductsRequestType;

class FindProductsRequestTypeTest extends \PHPUnit_Framework_TestCase
{
    private $obj;

    protected function setUp()
    {
        $this->obj = new FindProductsRequestType();
    }

    public function testCanBeCreated()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\Shopping\Types\FindProductsRequestType', $this->obj);
    }

    public function testExtendsAbstractRequestType()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\Shopping\Types\AbstractRequestType', $this->obj);
    }
}
