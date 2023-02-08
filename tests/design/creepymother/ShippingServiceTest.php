<?php

namespace PhpUnitWorkshopTest\design\creepymother;

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class ShippingServiceTest extends TestCase
{
    function testEstimateShippingCosts()
    {
        $customer = new Customer("Joe", "Romania", "whatever not null");

        $cost = (new ShippingService())->estimateShippingCosts($customer);

        assertEquals(20, $cost);
    }
}