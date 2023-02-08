<?php

namespace PhpUnitWorkshopTest\mocks;

class ClientVersion
{
    public function __construct(
        public readonly int $major,
        public readonly int $minor,
    )
    {
    }
    public function __toString(): string
    {
        return $this->major . "." . $this->minor;
    }
}