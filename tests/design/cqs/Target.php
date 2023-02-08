<?php

namespace PhpUnitWorkshopTest\design\cqs;

class Target
{
    private Dependency $dependency;

    public function __construct(Dependency $dependency)
    {
        $this->dependency = $dependency;
    }


    function testedMethod(Obj $obj)
    {
        // logic to test
        $x = $this->dependency->stuff($obj, 5);
        echo "Logic with " . $x;
        // TODO [HARD] how about temporal coupling? --> Immutables
    }
}