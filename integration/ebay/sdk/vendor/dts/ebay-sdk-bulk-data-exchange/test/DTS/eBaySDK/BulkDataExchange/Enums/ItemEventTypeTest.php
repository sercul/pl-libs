<?php

use DTS\eBaySDK\BulkDataExchange\Enums\ItemEventType;

class ItemEventTypeTest extends \PHPUnit_Framework_TestCase
{
    private $obj;

    protected function setUp()
    {
        $this->obj = new ItemEventType();
    }

    public function testCanBeCreated()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\BulkDataExchange\Enums\ItemEventType', $this->obj);
    }
}
