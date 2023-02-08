<?php

namespace PhpUnitWorkshopTest\design\fixturecreep;

interface Dependency
{
    function isOnionAllowed():bool;
    function isCucumberAllowed():bool;
}