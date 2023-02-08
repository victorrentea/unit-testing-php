<?php

namespace PhpUnitWorkshopTest\design\cqs;

class Dependency
{
    function stuff(Obj $obj, int $x)
    {
        // imagine complexity => tested separately
        $obj->setTotal($obj->getTotal() + $x); // side effect ==> command
        return $x * 2; // returns ==> query

    }
}
