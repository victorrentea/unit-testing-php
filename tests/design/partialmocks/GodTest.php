<?php

namespace PhpUnitWorkshopTest\design\partialmocks;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use PhpUnitWorkshopTest\design\fixturecreep\Dependency;
use PhpUnitWorkshopTest\design\fixturecreep\FastFood;
use function PHPUnit\Framework\assertEquals;

class GodTest extends TestCase
{
    function testHigh1(): void
    {
        $god = $this->createPartialMock(God::class, ['low']);
        $god->method('low')->willReturn('X');
        $order = new Order();
        $order->setPaymentMethod(PaymentMethod::CARD_ON_PURCHASE);

        $result = $god->high($order);

        assertEquals("bonusX", $result);
        // + 6 more tests like this
    }


    function testLow1(): void
    {
        $god = new God();
        $order = new Order();
        $order->setCreationDate(time() - 10);

        $result = $god->low($order);

        assertEquals("v", $result);
        // + 6 more tests like this
    }
}