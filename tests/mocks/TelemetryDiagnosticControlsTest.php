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
    private MockObject|TelemetryClient $clientMock;
    private TelemetryDiagnosticControls $target;

    protected function setUp(): void
    {
        parent::setUp(); // good habit pt cazuri cand exinzi din CustomTestCase
        $this->clientMock = $this->createMock(TelemetryClient::class);
        $this->target = new TelemetryDiagnosticControls($this->clientMock);
    }

    function testOk()
    {
        $this->clientMock->method('getOnlineStatus')->willReturn(true);

        $this->target->checkTransmission();

        self::assertTrue(true);
    }

    function testDisconnectsClient()
    {
        $this->clientMock->method('getOnlineStatus')->willReturn(true);
        $this->clientMock->expects(self::once())->method('disconnect');

        $this->target->checkTransmission();

        self::assertTrue(true);
    }


    function testThrowsWhenNotOnline()
    {
        $this->clientMock->method('getOnlineStatus')->willReturn(false);
        $this->expectExceptionMessage("SCAN_TOKEN_2RAISE_ALERT"); // mai precis

        $this->target->checkTransmission();

        self::assertTrue(true);
    }



}