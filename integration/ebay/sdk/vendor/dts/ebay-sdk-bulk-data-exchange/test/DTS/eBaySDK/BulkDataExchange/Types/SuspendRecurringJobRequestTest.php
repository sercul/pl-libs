<?php

use DTS\eBaySDK\BulkDataExchange\Types\SuspendRecurringJobRequest;

class SuspendRecurringJobRequestTest extends \PHPUnit_Framework_TestCase
{
    private $obj;

    protected function setUp()
    {
        $this->obj = new SuspendRecurringJobRequest();
    }

    public function testCanBeCreated()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\BulkDataExchange\Types\SuspendRecurringJobRequest', $this->obj);
    }

    public function testExtendsBaseServiceRequest()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\BulkDataExchange\Types\BaseServiceRequest', $this->obj);
    }
}
