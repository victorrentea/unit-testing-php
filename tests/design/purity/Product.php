<?php

namespace PhpUnitWorkshopTest\design\purity;

class Product
{
    public function __construct(
        public readonly int $id,
        public readonly ProductCategory $category
    )
    {
    }
}