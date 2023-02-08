<?php

namespace PhpUnitWorkshopTest\design\purity;

class Coupon
{
    public function __construct(
        public readonly int $id,
        public readonly int $discountAmount,
        public readonly bool $autoApply,
        public readonly ProductCategory $category
    )
    {
    }

    public function isApplicableFor(Product $product):bool
    {
        return $product->category == $this->category;
    }

    public function apply(Product $product, mixed $price): float
    {
        if (!$this->isApplicableFor($product)) {
            throw new \Exception();
        }
        return $price - $this->discountAmount;
    }
}