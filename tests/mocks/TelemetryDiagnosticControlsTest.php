<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 01-Aug-18
 * Time: 12:58 PM
 */

namespace PhpUnitWorkshopTest\mocks;


use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TelemetryDiagnosticControlsTest extends TestCase
{
    function testCovrigi()
    {
        $sut = new TelemetryDiagnosticControls(new TelemetryClient());
        $sut->checkTransmission();
        self::assertTrue(true);
    }
}