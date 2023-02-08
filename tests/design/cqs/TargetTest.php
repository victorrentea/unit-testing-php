<?php

namespace PhpUnitWorkshopTest\design\cqs;

use Distill\Format\Simple\Tar;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use PhpUnitWorkshop\mocks\TelemetryClient;
use PhpUnitWorkshop\mocks\TelemetryDiagnosticControls;

class TargetTest extends TestCase
{
    private Dependency|MockObject $dependency;
    private Target $target;

    public function setUp():void
    {
        $this->dependency = $this->createMock(Dependency::class);
        $this->target = new Target($this->dependency);
    }


    public function testCheckTransmissionThrowsWhenGetOnlineStatusReturnsFalse()
    {
        $obj = new Obj();
        $this->dependency->expects($this->exactly(1))
            ->method('stuff')
            ->with($obj, 5)
            ->willReturn(false);

        $this->target->testedMethod($obj);
    }
}