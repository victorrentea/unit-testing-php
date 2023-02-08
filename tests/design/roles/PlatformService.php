<?php

namespace PhpUnitWorkshopTest\design\roles;

class PlatformService
{
    function addParcel(Parcel $parcel): void
    {
        echo "Parcel loaded on platform $parcel";
    }
}