<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 01-Aug-18
 * Time: 12:58 PM
 */

namespace PhpUnitWorkshopTest\mocks;


use http\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TelemetryDiagnosticControlsTest extends TestCase
{
    function testOk()
    {
        $clientMock = $this->createMock(TelemetryClient::class);
        $target = new TelemetryDiagnosticControls($clientMock);
        $clientMock->method('getOnlineStatus')->willReturn(true);

        $target->checkTransmission();

        self::assertTrue(true);
    }

    function testDisconnectsClient()
    {
        $clientMock = $this->createMock(TelemetryClient::class);
        $target = new TelemetryDiagnosticControls($clientMock);
        $clientMock->method('getOnlineStatus')->willReturn(true);
        $clientMock->expects(self::once())->method('disconnect');

        $target->checkTransmission();

        self::assertTrue(true);
    }


    function testThrowsWhenNotOnline()
    {
        $clientMock = $this->createMock(TelemetryClient::class);
        $target = new TelemetryDiagnosticControls($clientMock);
        $clientMock->method('getOnlineStatus')->willReturn(false);
        $this->expectExceptionMessage("SCAN_TOKEN_2RAISE_ALERT"); // mai precis

        $target->checkTransmission();

        self::assertTrue(true);
    }



}