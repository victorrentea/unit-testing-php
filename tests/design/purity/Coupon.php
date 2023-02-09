<?php

namespace PhpUnitWorkshopTest\design\purity;

use JetBrains\PhpStorm\Pure;

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

    #[Pure]
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