<?php

namespace PhpUnitWorkshopTest\design\signatures;

use PHPUnit\Framework\TestCase;

class PreciseTest extends TestCase
{
    function testPrecise(): void
    {
        $project = new Project();
        $project->setPoEmail('boss@my.corp');

        Precise::sendSprintFinishedEmail($project);

        $this->expectOutputString("Sending email to boss@my.corp with subject 'Sprint Finished' and some body");
    }
}