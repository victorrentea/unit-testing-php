<?php

namespace PhpUnitWorkshopTest\design\purity;

class Customer
{
    /**
     * @param Coupon[] $coupons
     */
    public function __construct(public readonly array $coupons)
    {
    }
}