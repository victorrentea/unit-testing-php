<?php

namespace PhpUnitWorkshopTest\design\signatures;

use PHPUnit\Framework\TestCase;

class PreciseTest extends TestCase
{
    function testPrecise(): void
    {

        Precise::sendSprintFinishedEmail('boss@my.corp');

        $this->expectOutputString("Sending email to boss@my.corp with subject 'Sprint Finished' and some body");
    }
}