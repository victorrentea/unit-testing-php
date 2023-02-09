<?php

namespace PhpUnitWorkshopTest\design\roles;

class TrackingService
{
    public function __construct(private readonly TrackingProviderRepo $trackingProviderRepo)
    {
    }

    function markDepartingWarehouse(string $awb, int $warehouseId)
    {
        $trackingProviders = $this->trackingProviderRepo->findByAwb($awb);
        //$trackingProviders
    }
}