<?php

namespace PhpUnitWorkshopTest\design\purity;

interface CustomerRepo
{
    function findById(int $id): Customer;
}