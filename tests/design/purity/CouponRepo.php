<?php

namespace PhpUnitWorkshopTest\design\purity;

interface CouponRepo
{

    public function markUsedCoupons(int $customerId, array $usedCouponIds);
}