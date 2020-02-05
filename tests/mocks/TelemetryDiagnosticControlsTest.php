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
    private $client;
    /**
     * @var TelemetryDiagnosticControls
     */
    private $controls;

    protected function setUp()
    {
        $this->client = $this->createMock(TelemetryClient::class);
        $this->controls = new TelemetryDiagnosticControls();
        $this->controls->setTelemetryClient($this->client);
    }

    /** @throws \Exception */
    public function testDisconnects()
    {
        $this->client->method('getOnlineStatus')->willReturn(true);
        $this->client->expects($this->once())
            ->method('disconnect');

        $this->controls->checkTransmission();
    }
    /** @throws \Exception */
    public function testSends()
    {
        $this->client->method('getOnlineStatus')->willReturn(true);

        $this->client->expects($this->once())
            ->method('send')
            ->with(TelemetryClient::DIAGNOSTIC_MESSAGE);

        $this->controls->checkTransmission();
    }
    public function testThrowsWhenNotOnline()
    {
        $this->client->method('getOnlineStatus')->willReturn(false);
        $this->expectExceptionMessage('connect');

        $this->controls->checkTransmission();
    }
    public function testReceives()
    {
        $this->client->method('getOnlineStatus')->willReturn(true);
        $this->client/*->expects($this->once())*/
            ->method('receive')
            ->willReturn('tataie');

        $this->controls->checkTransmission();
        self::assertEquals("tataie", $this->controls->getDiagnosticInfo());
    }

    public function testConfiguresClient()
    {
        $this->client->method('getOnlineStatus')->willReturn(true);
        $this->client->expects($this->once())
            ->method('configure');

        $this->controls->checkTransmission();
    }

    public function testConfiguration()
    {
        $this->client->method('getOnlineStatus')->willReturn(true);

        $config = $this->controls->createConfig();
//        assertEquals();
    }



}