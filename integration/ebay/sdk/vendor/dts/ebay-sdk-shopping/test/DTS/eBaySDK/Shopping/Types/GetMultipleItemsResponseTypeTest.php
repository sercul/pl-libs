<?php

use DTS\eBaySDK\Shopping\Types\GetMultipleItemsResponseType;

class GetMultipleItemsResponseTypeTest extends \PHPUnit_Framework_TestCase
{
    private $obj;

    protected function setUp()
    {
        $this->obj = new GetMultipleItemsResponseType();
    }

    public function testCanBeCreated()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\Shopping\Types\GetMultipleItemsResponseType', $this->obj);
    }

    public function testExtendsAbstractResponseType()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\Shopping\Types\AbstractResponseType', $this->obj);
    }
}
