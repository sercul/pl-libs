<?php

use DTS\eBaySDK\BulkDataExchange\Enums\IncludeListingType;

class IncludeListingTypeTest extends \PHPUnit_Framework_TestCase
{
    private $obj;

    protected function setUp()
    {
        $this->obj = new IncludeListingType();
    }

    public function testCanBeCreated()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\BulkDataExchange\Enums\IncludeListingType', $this->obj);
    }
}
