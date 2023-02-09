<?php

namespace PhpUnitWorkshopTest\design\creepymother;

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class InvoiceServiceTest extends TestCase
{
    function testInvoice()
    {
        $customer = TestDataForInvoicing::marcel();

        $invoice = (new InvoiceService())->generateInvoice($customer, "Order1");

        assertEquals("Invoice\n" .
            "Buyer: BillingAddress\n" .
            "For order Order1", $invoice);
    }
}