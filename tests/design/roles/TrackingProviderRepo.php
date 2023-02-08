<?php

namespace PhpUnitWorkshopTest\design\roles;

interface TrackingProviderRepo
{
    /**
     * @return TrackingProvider[]
     */
    function findByAwb(string $awb): array;

}