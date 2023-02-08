<?php

namespace PhpUnitWorkshopTest\design\purity;

interface ProductRepo
{

    /**
     * @param int[] $productIds
     * @return Product[]
     */
    public function findAllById(array $productIds):array;
}