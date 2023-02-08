<?php

namespace PhpUnitWorkshopTest\mocks;


use PHPUnit\Framework\TestCase;

class CreateConfigTest extends TestCase
{

    const UNIQUEID_LENGTH = 13;

    function test1(): void
    {
        $clientMock = $this->createMock(TelemetryClient::class);
        $target = new TelemetryDiagnosticControls($clientMock);
        $config = $target->createConfiguration(new ClientVersion(1,0));

        //        self::assertMatchesRegularExpression('#1-\w{13}$#', $config->getSessionId());

        self::assertEquals(strlen('1.0-') + self::UNIQUEID_LENGTH, strlen($config->getSessionId()));
        self::assertStringStartsWith('1.0-', $config->getSessionId());
        echo $config->getSessionId();
        TestUtils::assertJustNow($config->getSessionStart());
        self::assertEquals(TelemetryClientConfiguration::ACK_NORMAL, $config->getAckMode()); // ruleaza la linia 100
    }
}