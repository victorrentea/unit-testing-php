<?php

namespace PhpUnitWorkshopTest\design\creepymother;

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class InvoiceServiceTest extends TestCase
{
    function testInvoice()
    {
        $customer = new Customer("Joe", "whatever not null", "BillingAddress");

        $invoice = (new InvoiceService())->generateInvoice($customer, "Order1");

        assertEquals("Invoice\n" .
            "Buyer: BillingAddress\n" .
            "For order Order1", $invoice);
    }
}