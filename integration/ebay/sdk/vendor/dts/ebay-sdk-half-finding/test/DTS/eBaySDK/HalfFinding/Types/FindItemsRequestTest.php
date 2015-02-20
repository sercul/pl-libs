<?php

use DTS\eBaySDK\HalfFinding\Types\FindItemsRequest;

class FindItemsRequestTest extends \PHPUnit_Framework_TestCase
{
    private $obj;

    protected function setUp()
    {
        $this->obj = new FindItemsRequest();
    }

    public function testCanBeCreated()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\HalfFinding\Types\FindItemsRequest', $this->obj);
    }

    public function testExtendsBaseRequest()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\HalfFinding\Types\BaseRequest', $this->obj);
    }
}
