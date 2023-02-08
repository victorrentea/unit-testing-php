<?php

namespace PhpUnitWorkshopTest\design\purity;

interface ThirdPartyPrices
{

    public function retrievePrice(int $id) : float;
}