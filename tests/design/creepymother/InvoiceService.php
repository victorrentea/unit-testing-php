<?php

namespace PhpUnitWorkshopTest\design\creepymother;

class InvoiceService
{
    function generateInvoice(Customer $customer, string $order)
    {
        $invoice = "Invoice\n";
        $invoice .= "Buyer: " . $customer->getBillingAddress() . "\n";
        $invoice .= "For order " . $order;
        // more
        return $invoice;
    }
}