<?php

use DTS\eBaySDK\Shopping\Enums\ReviewSortCodeType;

class ReviewSortCodeTypeTest extends \PHPUnit_Framework_TestCase
{
    private $obj;

    protected function setUp()
    {
        $this->obj = new ReviewSortCodeType();
    }

    public function testCanBeCreated()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\Shopping\Enums\ReviewSortCodeType', $this->obj);
    }
}
