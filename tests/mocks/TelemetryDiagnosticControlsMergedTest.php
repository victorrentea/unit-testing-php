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

class TelemetryDiagnosticControlsMergedTest extends TestCase
{
    const DIAGNOSTIC = "##diagnostic##";
    private MockObject|TelemetryClient $clientMock;
    private TelemetryDiagnosticControls $target;

    protected function setUp(): void // runs before each test
    {
        parent::setUp(); // good habit pt cazuri cand exinzi din CustomTestCase
        $this->clientMock = $this->createMock(TelemetryClient::class);
//        $this->target = new TelemetryDiagnosticControls($this->clientMock);
        $this->target = $this->createPartialMock(TelemetryDiagnosticControls::class,
            ['createConfiguration']);
        $this->target->setTelemetryClient($this->clientMock);

//        // Iarta-ma! mama masii ca n-am nevoie de asta; cum o se uite la asta cine mentine testul?
//        $this->clientMock->method('getVersion')->willReturn(new ClientVersion(9,9));
    }

    function testThrowsWhenNotOnline_OAIA_NEAGRA()
    {
        $this->clientMock->method('getOnlineStatus')->willReturn(false);
        $this->expectExceptionMessage("SCAN_TOKEN_2RAISE_ALERT"); // mai precis

        $this->target->checkTransmission();
    }

    // TRADARE!
    function testOk()
    {
        $this->clientMock->method('getOnlineStatus')->willReturn(true);
        $this->clientMock->expects(self::once())->method('disconnect');
        $this->clientMock->expects(self::once())->method('send')
            ->with(TelemetryClient::DIAGNOSTIC_MESSAGE);
        $this->clientMock->method('receive')->willReturn(self::DIAGNOSTIC);

        $this->target->checkTransmission();

        self::assertEquals(self::DIAGNOSTIC, $this->target->getDiagnosticInfo());
    }
    function testConfiguresClient()
    {
        $this->clientMock->method('getOnlineStatus')->willReturn(true);
        $this->clientMock->expects(self::once())->method('configure');

        $this->target->checkTransmission();

    }

}