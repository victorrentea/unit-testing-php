<?php


namespace PhpUnitWorkshopTest\mocks;


class TelemetryClientConfigFactory
{
    public function createConfig(int $currentRetry): TelemetryClientConfiguration
    {
        $config = new TelemetryClientConfiguration();
        $config->setSessionId(uniqid() . "_$currentRetry");
        $config->setSessionStart(time());
        $config->setAckMode(TelemetryClientConfiguration::ACK_NORMAL);
        return $config; //this?!
    }
}