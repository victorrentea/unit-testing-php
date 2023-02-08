<?php

namespace PhpUnitWorkshopTest\design\cqs;

class Obj
{
    private int $total;

    public function getTotal(): int
    {
        return $this->total;
    }

    public function setTotal(int $total): void
    {
        $this->total = $total;
    }

}