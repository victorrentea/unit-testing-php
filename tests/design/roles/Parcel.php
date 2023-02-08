<?php

namespace PhpUnitWorkshopTest\design\roles;

class Parcel
{
    public function __construct(
        public readonly string $barcode,
        public readonly string $awb,
        public readonly bool $partOfCompositeShipment
    )
    {
    }

}