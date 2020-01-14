<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 01-Aug-18
 * Time: 12:58 PM
 */

namespace PhpUnitWorkshop\mocks;

include "TelemetryDiagnosticControls.php";
include "Random.php";
include "TelemetryClientConfiguration.php";
include "TelemetryClient.php";


use Mockery\Mock;
use PHPUnit\Framework\MockObject\MockBuilder;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TelemetryDiagnosticControlsTest extends TestCase
{
    private $mockClient;
    private $mockConfigProvider;
    private $controls;

    protected function setUp()
    {
        $this->mockClient = $this->createMock(TelemetryClient::class);
        $this->mockConfigProvider = $this->createMock(ConfigProvider::class);
        $this->controls = new TelemetryDiagnosticControls($this->mockClient,$this->mockConfigProvider);
    }

    public function testDisconnects()
    {
        $this->mockClient->method("getOnlineStatus")->willReturn(true);
        $this->mockClient->expects($this->exactly(1))->method("disconnect");
        $this->controls->checkTransmission();
    }
    public function testThrowsWhenNotOnline()
    {
        $this->mockClient->method("getOnlineStatus")->willReturn(false);
        $this->expectExceptionCode(13);
        $this->controls->checkTransmission();
    }
    public function testSends()
    {
        $this->mockClient->method("getOnlineStatus")->willReturn(true); // stubbing
        $this->mockClient->expects($this->once())->method("send")->with(TelemetryClient::DIAGNOSTIC_MESSAGE);
        $this->controls->checkTransmission();
    }

    public function testCallsReceive()
    {
        $this->mockClient->method("getOnlineStatus")->willReturn(true); // stubbing
        $this->mockClient/*->expects($this->once())*/ // redundant!!!
            ->method("receive")
            ->willReturn("tataie");
        $this->controls->checkTransmission();
        $this->assertEquals("tataie",$this->controls->getDiagnosticInfo());
    }

    public function testTomberon() // debatable
    {
        $orice = new TelemetryClientConfiguration();
        $this->mockClient->expects($this->exactly(1))->method("disconnect");
        $this->mockClient->method("getOnlineStatus")->willReturn(true); // stubbing
        $this->mockClient->expects($this->once())->method("send")->with(TelemetryClient::DIAGNOSTIC_MESSAGE);
        $this->mockConfigProvider->method("createConfig")->willReturn($orice);
        $this->mockClient/*->expects($this->once())*/ // redundant!!!
            ->method("receive")
            ->willReturn("tataie");
        $this->mockClient->expects($this->once())->method("configure")->with($orice);
        $this->controls->checkTransmission();
        $this->assertEquals("tataie",$this->controls->getDiagnosticInfo());
    }




//    public function testPescuitDeArgumente() {
//        $this->mockClient->method("getOnlineStatus")->willReturn(true);
//        /** @var TelemetryClientConfiguration $config */
//        $config = null;
//        $this->mockClient->expects($this->once())
//            ->method("configure")
//            ->with($this->callback(function(TelemetryClientConfiguration $actualConfig) use (&$config) {
//                $config = $actualConfig;
//                return true;
//            }));
//        $this->controls->checkTransmission();
//        $this->assertEquals(TelemetryClientConfiguration::ACK_NORMAL, $config->getAckMode());
//        $this->assertEquals(time(), $config->getSessionStart()); //JDD
//    }


//    public function testPescuitDeArgumente() {
//        $this->mockClient->method("getOnlineStatus")->willReturn(true);
//        $this->mockClient->expects($this->once())
//            ->method("configure")
//            ->with($this->callback(function(TelemetryClientConfiguration $config) {
//                $this->assertEquals(TelemetryClientConfiguration::ACK_NORMAL, $config->getAckMode());
//                $this->assertEquals(time(), $config->getSessionStart()); //JDD
//                return true;
//            }));
//        $this->controls->checkTransmission();
//    }

    public function testCreateConfig() {
        $config = (new ConfigProvider())->createConfig();
        $this->assertEquals(TelemetryClientConfiguration::ACK_NORMAL, $config->getAckMode());
        $this->assertEquals(time(), $config->getSessionStart()); //JDD
    }
}