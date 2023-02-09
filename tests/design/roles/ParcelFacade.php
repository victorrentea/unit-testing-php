<?php

namespace PhpUnitWorkshopTest\design\roles;

class ParcelFacade
{
    public function __construct(
        private readonly ParcelRepo           $parcelRepo,
        private readonly DisplayService       $displayService,
        private readonly PlatformService      $platformService,
        private readonly TrackingService      $trackingService,
        private readonly TrackingProviderRepo $trackingProviderRepo,
    )
    {
    }

    function processParcel(string $barcode, int $warehouseId)
    {
        $parcel = $this->parcelRepo->findByBarcode($barcode);

        $this->displayService->displayAWB($parcel);
        if ($parcel->partOfCompositeShipment) {
            $this->displayService->displayMultiParcelWarning();
        }
        $this->platformService->addParcel($parcel);
        $trackingProviders = $this->trackingProviderRepo->findByAwb($parcel->awb);
        $this->trackingService->markDepartingWarehouse($parcel->awb, $warehouseId, $trackingProviders);
    }
}