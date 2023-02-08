<?php

namespace PhpUnitWorkshopTest\design\fixturecreep;

use Exception;

class FastFood
{
    public function __construct(private readonly Dependency $dependency)
    {
    }

    function makeShawarma(): string
    {
        if (!$this->dependency->isOnionAllowed()) {
            throw new Exception("Inconceivable Shawarma");
        }
        // complex logic
        return "Yummy Shawarma";
    }

    function makeTzatziki(): string
    {
        if (!$this->dependency->isCucumberAllowed()) {
            throw new Exception("That's not a tzatziki anymore");
        }
        // complex logic
        return "Cold Tzatziki";
    }
}