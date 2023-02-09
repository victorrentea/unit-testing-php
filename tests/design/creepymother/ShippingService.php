<?php

namespace PhpUnitWorkshopTest\design\creepymother;

class ShippingService
{
//    function estimateShippingCosts(Customer $customer)
    function estimateShippingCosts(CustomerForShipping $customer) //
        // CustomerForShipping poate fi (daca ai ff multe teste pe zona aia de cod 15-20)
        // a) Value Obiect cu campuri readonly extrase din starea entitatii Customer
        // b) @Entitate diferita de  @Entity CustomerForInvoicing -> HORROR!
    {
        // 15 teste de pus aici
        if (!str_contains($customer->getShippingAddress(), "Romania")) {
            return 50;
        }
        // more logic
        return 20;
    }

}