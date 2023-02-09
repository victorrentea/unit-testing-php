<?php

namespace PhpUnitWorkshopTest\design\roles;

class ParcelFacade
{
    public function __construct(
        private readonly ParcelRepo           $parcelRepo,
        private readonly DisplayService       $displayService,
        private readonly PlatformService      $platformService,
        private readonly TrackingService      $trackingService,
    )
    {
    }

    function processParcel(string $barcode, int $warehouseId)
    {
        $parcel = $this->parcelRepo->findByBarcode($barcode);

        $this->displayService->displayAWB($parcel);

        $this->platformService->addParcel($parcel);

        $this->trackingService->markDepartingWarehouse($parcel->awb, $warehouseId);
    }
}