<?php

namespace PhpUnitWorkshopTest\design\creepymother;

class ShippingService
{
    function estimateShippingCosts(Customer $customer)
    {
        if (!str_contains($customer->getShippingAddress(), "Romania")) {
            return 50;
        }
        // more logic
        return 20;
    }

}