<?php

namespace PhpUnitWorkshopTest\design\fixturecreep;

use Exception;

class ShawarmaFood
{
    public function __construct(private readonly Dependency $dependency)
    {
    }

    function makeShawarma(): string
    {
        if (!$this->dependency->isOnionAllowed()) {
            throw new Exception("Inconceivable Shawarma");
        }
        // complex logic complicat + 7 teste
        return "Yummy Shawarma";
    }
}
