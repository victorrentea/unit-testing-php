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
    const DIAGNOSTIC = "##diagnostic##";
    private MockObject|TelemetryClient $clientMock;
    private TelemetryDiagnosticControls $target;

    protected function setUp(): void // runs before each test
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


    function testSendsDiagnosticMessage()
    {
        $this->clientMock->method('getOnlineStatus')->willReturn(true);
        $this->clientMock->expects(self::once())
            ->method('send')
            ->with(TelemetryClient::DIAGNOSTIC_MESSAGE)
//            ->with("AT#UD")// doar cand CHIAR vrei sa-ti pice testu daca produ da altceva
        ;
        $this->target->checkTransmission();

        self::assertTrue(true);
    }

    function testReceivesDiagnosticInfo()
    {
        $this->clientMock->method('getOnlineStatus')->willReturn(true);
        $this->clientMock
//            ->expects(self::once())
                // are sens daca :
                    // 1) apelul poate sa intoarca altceva la al doilea apel (eg : SELECT COUNT(T) FROM ORDERS)
                    // 2) apelul modifica chestii (i++ undeva)
                    // 3) apelul dureaza timp/$ ( ca sa nu repeti apelul): eg api call
            ->method('receive')
            ->willReturn(self::DIAGNOSTIC);

        // daca functia e PURE FUNCTION, nu ar trebui sa-i faci expects();

        $this->target->checkTransmission();

        self::assertEquals(self::DIAGNOSTIC, $this->target->getDiagnosticInfo());
    }


    function testConfiguresClient()
    {
        $this->clientMock->method('getOnlineStatus')->willReturn(true);
        $this->clientMock->expects(self::once())->method('configure')
            ->will(self::returnCallback(function (TelemetryClientConfiguration $config) {
                self::assertEquals(TelemetryClientConfiguration::ACK_NORMAL, $config->getAckMode()); // ruleaza la linia 100
            }));

        $this->target->checkTransmission();

        self::assertTrue(true);
    }


}