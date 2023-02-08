<?php

namespace PhpUnitWorkshopTest\design\roles;

interface ParcelRepo
{
    function findByBarcode(string $barcode): Parcel;
}