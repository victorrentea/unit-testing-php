<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 01-Aug-18
 * Time: 12:38 PM
 */

namespace PhpUnitWorkshopTest\mocks;


class TelemetryDiagnosticControls
{
    public const DIAGNOSTIC_CHANNEL_CONNECTION_STRING = '*111#';

    private $telemetryClient;
    private $diagnosticInfo = "";
    private $configuration;

    public function getConfiguration()
    {
        return $this->configuration;
    }
    public function __construct(TelemetryClient $telemetryClient)
    {
        $this->telemetryClient = $telemetryClient;
    }

//    function sendDiagnostic() {
//        send($this->diagnosticInfo);
//    }
    public function getDiagnosticInfo(): string
    {
        return $this->diagnosticInfo;
    }

    public function setDiagnosticInfo(String $diagnosticInfo): void
    {
        $this->diagnosticInfo = $diagnosticInfo;
    }

    public function checkTransmission()
    {
        $this->telemetryClient->disconnect();

        $currentRetry = 1;
//        while (!$this->telemetryClient->getOnlineStatus() && $currentRetry <= 3) {
//            $this->telemetryClient->connect(self::DIAGNOSTIC_CHANNEL_CONNECTION_STRING);
//            $currentRetry++;
//        }

        if (!$this->telemetryClient->getOnlineStatus()) {
            throw new \Exception("[SCAN_TOKEN_2RAISE_ALERT]Cannot connect despite my attempt");
        }

        $this->configuration = $this->createConfiguration();
        $this->telemetryClient->configure($this->configuration);

        $this->telemetryClient->send(TelemetryClient::DIAGNOSTIC_MESSAGE);
        $this->diagnosticInfo = $this->telemetryClient->receive();
    }

    private function createConfiguration(): TelemetryClientConfiguration
    {
        $config = new TelemetryClientConfiguration();
        $config->setSessionId(uniqid());
        $config->setSessionStart(time());
        $config->setAckMode(TelemetryClientConfiguration::ACK_NORMAL);
        return $config;
    }
}