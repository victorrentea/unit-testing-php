<?php


namespace PhpUnitWorkshopTest;


use PHPUnit\Framework\TestCase;

class AnInactiveCustomerTest extends TestCase
{
    protected $userIdInDB;
    protected function setUp()
    {
        echo "in super\n";
    }

}
class WithActiveOrders extends AnInactiveCustomerTest {

    protected function setUp()
    {
        parent::setUp();
        echo "din sub\n";
    }
    public function test1() {
        self::assertEquals("newPhone\nXXX","oldPhone\nXXX");
    }

    public function testUnArrayCeContine() {
        $arr = ['a'];


        self::assertEquals(['a'],$arr);
    }
}

