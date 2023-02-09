<?php

namespace PhpUnitWorkshopTest\design\roles;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\Test;
use PHPUnit\Framework\TestCase;
use PhpUnitWorkshopTest\design\purity\CouponRepo;
use PhpUnitWorkshopTest\design\purity\CustomerRepo;
use PhpUnitWorkshopTest\design\purity\PriceService;
use PhpUnitWorkshopTest\design\purity\ProductRepo;
use PhpUnitWorkshopTest\design\purity\ThirdPartyPrices;

class ParcelFacadeTest extends TestCase
{
    private ParcelRepo|MockObject $parcelRepo;
    private DisplayService|MockObject $displayService;
    private PlatformService|MockObject $platformService;
    private TrackingService|MockObject $trackingService;
    private TrackingProviderRepo|MockObject $trackingProviderRepo;

    private ParcelFacade $target;

    public function setUp(): void
    {
        $this->parcelRepo = $this->createMock(ParcelRepo::class);
        $this->displayService = $this->createMock(DisplayService::class);
        $this->platformService = $this->createMock(PlatformService::class);
        $this->trackingService = $this->createMock(TrackingService::class);
        $this->trackingProviderRepo = $this->createMock(TrackingProviderRepo::class);
        $this->target = new ParcelFacade($this->parcelRepo, $this->displayService, $this->platformService, $this->trackingService, $this->trackingProviderRepo);
    }

    function testProcessParcel(): void
    {
        $parcel = new Parcel("BARCODE", "AWB", true);
        $this->parcelRepo->method('findByBarcode')->with('BARCODE')->willReturn($parcel);
        $trackingProviders = [new TrackingProvider(1)];

        // stubbing: inveti o metoda ce sa-ti intoarca in codul setat -> "QUERIES"
        $this->trackingProviderRepo->expects(self::once())->method('findByAwb')
            ->with('AWB')->willReturn($trackingProviders);

//        $this->vatCalculatorMock->method('calculateVAT')->willReturn(15.0);
// nu mockuiesti functii din *Util: ci ar trebui ca acele fct sa fie robuste la date corupte -> sa nu crape.

        // mocking: verifici ca un apel de metoda chiar s-a intamplat -> "COMMANDS"
        $this->displayService->expects(self::once())->method('displayAWB')->with($parcel);

        $this->displayService->expects(self::once())
            ->method('displayMultiParcelWarning');
        $this->platformService->expects(self::once())->method('addParcel')
            ->with($parcel);
        $this->trackingService->expects(self::once())
            ->method('markDepartingWarehouse')
            ->with('AWB', 17, $trackingProviders);

        $this->target->processParcel("BARCODE",17);
    }
}