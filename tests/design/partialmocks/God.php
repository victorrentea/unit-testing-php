<?php

namespace PhpUnitWorkshopTest\design\partialmocks;

use function PHPUnit\Framework\once;

class God
{
    function high(Order $order)
    {
        $s = $this->low($order);
        // complexity requiring 8 tests
        if ($order->getPaymentMethod() == PaymentMethod::CARD_ON_PURCHASE) {
            return 'bonus' . $s;
        }
        return 'regular' . $s;
    }

    function low(Order $order): string
    {
        // complexity requiring 7 tests
        if (time() - $order->getCreationDate() > 30 * 24 * 3600) {
            throw new \Exception("Order too old");
        }
        return "v";
    }
}