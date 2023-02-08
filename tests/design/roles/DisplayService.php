<?php

namespace PhpUnitWorkshopTest\design\roles;

class DisplayService
{
    function displayAWB(Parcel $parcel)
    {
        echo "Display barcode " . $parcel->barcode;
    }

    function displayMultiParcelWarning()
    {
        echo "WARNING: Multi-parcel shipment";
    }


}