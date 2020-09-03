<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 01-Aug-18
 * Time: 12:58 PM
 */

namespace PhpUnitWorkshopTest\mocks;


use PHPUnit\Framework\TestCase;

class TelemetryDiagnosticControlsTest extends TestCase
{

    /** @test */
    public function disconnects()
    {
        $client = $this->createMock(TelemetryClient::class);
        $client->method("getOnlineStatus")->willReturn(true);
        $controls = new TelemetryDiagnosticControls($client);
        $client->expects($this->once())->method("disconnect");
        $controls->checkTransmission();
    }
    /** @test */
    public function sendsDiagnosticControls()
    {
        $client = $this->createMock(TelemetryClient::class);
        $client->method("getOnlineStatus")->willReturn(true);
        $controls = new TelemetryDiagnosticControls($client);


        // $client->expects($this->once())->method("send")->with(TelemetryClient::DIAGNOSTIC_MESSAGE);

        // external protocol/format
        $client->expects($this->once())->method("send")->with("AT#UD");

        $controls->checkTransmission();
    }


    /** @test
     * @expectedException \Exception
     */
    public function throwsWhenNotOnline()
    {
        $client = $this->createMock(TelemetryClient::class);
        $client->method("getOnlineStatus")->willReturn(false);
        $controls = new TelemetryDiagnosticControls($client);
        $controls->checkTransmission();
    }
}