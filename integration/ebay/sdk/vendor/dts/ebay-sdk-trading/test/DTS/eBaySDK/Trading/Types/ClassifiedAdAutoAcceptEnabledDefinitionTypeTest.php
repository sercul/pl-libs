<?php

use DTS\eBaySDK\Trading\Types\ClassifiedAdAutoAcceptEnabledDefinitionType;

class ClassifiedAdAutoAcceptEnabledDefinitionTypeTest extends \PHPUnit_Framework_TestCase
{
    private $obj;

    protected function setUp()
    {
        $this->obj = new ClassifiedAdAutoAcceptEnabledDefinitionType();
    }

    public function testCanBeCreated()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\Trading\Types\ClassifiedAdAutoAcceptEnabledDefinitionType', $this->obj);
    }

    public function testExtendsBaseType()
    {
        $this->assertInstanceOf('\DTS\eBaySDK\Types\BaseType', $this->obj);
    }
}
