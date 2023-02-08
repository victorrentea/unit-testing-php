<?php

namespace PhpUnitWorkshopTest\mocks;

use Emag\Core\JiraApiBundle\Tests\Unit\TestCase;

class CreateConfigTest extends TestCase
{
//
    function test1(): void
    {
        $sut = new TelemetryDiagnosticControls();
        $config = $sut->createConfiguration();
        // + 6 teste ca asta ....
    }
}