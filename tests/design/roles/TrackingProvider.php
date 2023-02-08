<?php

namespace PhpUnitWorkshopTest\design\roles;

class TrackingProvider
{
    public function __construct(
        public readonly int $id
    )
    {
    }
}