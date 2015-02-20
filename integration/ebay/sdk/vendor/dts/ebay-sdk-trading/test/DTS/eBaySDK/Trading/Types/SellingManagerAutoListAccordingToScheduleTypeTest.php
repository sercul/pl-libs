<?php

use DTS\eBaySDK\Trading\Types\SellingManagerAutoListAccordingToScheduleType;

class SellingManagerAutoListAccordingToScheduleTypeTest extends \PHPUnit_Framework_TestCase
{
    private $obj;

    protected function setUp()
    {
        $this->obj = new SellingManagerAutoListAccordingToScheduleType();
    }

    public function testCanBeCreated()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\Trading\Types\SellingManagerAutoListAccordingToScheduleType', $this->obj);
    }

    public function testExtendsBaseType()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\Types\BaseType', $this->obj);
    }
}
