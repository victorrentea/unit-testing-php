<?php

namespace PhpUnitWorkshopTest\design\fixturecreep;

class TzatzikiFood
{
    public function __construct(private readonly Dependency $dependency)
    {
    }

    function makeTzatziki(): string
    {

        var_dump($this->dependency->isCucumberAllowed());
        if (!$this->dependency->isCucumberAllowed()) {
            throw new \Exception("That's not a tzatziki anymore");
        }
        // complex logic + 7 teste
        return "Cold Tzatziki";
    }
}