<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 01-Aug-18
 * Time: 12:58 PM
 */

namespace PhpUnitWorkshopTest\mocks;


use PHPUnit\Framework\TestCase;
use PhpUnitWorkshopTest\mocks\TelemetryClient;
use PhpUnitWorkshopTest\mocks\TelemetryDiagnosticControls;

class TelemetryDiagnosticControlsTest extends TestCase
{

    /** @test */
    public function first() {
//        $client = new TelemetryClient();
        $client = $this->createMock(TelemetryClient::class);
        $controls = new TelemetryDiagnosticControls($client);
        $controls->checkTransmission();
    }
}