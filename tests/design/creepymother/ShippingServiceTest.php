<?php

namespace PhpUnitWorkshopTest\design\creepymother;

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class ShippingServiceTest extends TestCase
{
    function testEstimateShippingCosts()
    {
//        $customer->method('getAddress')->willReturn('Romania')// 0) niciodata -> inseamna ca e prea complexa entitatea aceea.

//        $customer = $this->aCustomer(); //1) ai pus gunoiu altundeva, dar tot in clasa asta e

        $customer = TestDataForShipping::marcel();  //2) Object Mother __cker Pattern
        // pai cum, nu-l stii pe Joe? am vb de el in 5 sedinte cu bizu pana acum....
        // Joe e o 'persona'

//        Customer::newCorporateCustomer(doar5param_nu8)// 3) da, daca si din prod e utila. Tot m-as intreba de ce nu oare class CorporateCustomer { private DefaultCustomer $defaultCustomer}

        $cost = (new ShippingService())->estimateShippingCosts($customer);

        assertEquals(20, $cost);
    }

    public function aCustomer(): Customer
    {
        return new Customer("Joe",
            "Romania",
            "whatever not null");
    }
}