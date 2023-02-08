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

        if (!$this->telemetryClient->getOnlineStatus()) {
            throw new \Exception("[SCAN_TOKEN_2RAISE_ALERT]Cannot connect despite my attempt");
        }

        $version = $this->telemetryClient->getVersion();
        $this->telemetryClient->configure($this->createConfiguration($version));

        $this->telemetryClient->send(TelemetryClient::DIAGNOSTIC_MESSAGE);
        $this->diagnosticInfo = $this->telemetryClient->receive();
    }

    public function createConfiguration(?ClientVersion $version): TelemetryClientConfiguration
    {
        $config = new TelemetryClientConfiguration();
        $config->setSessionId($version . '-' . uniqid());
        $config->setSessionStart(time());
        $config->setAckMode(TelemetryClientConfiguration::ACK_NORMAL);
        // Imagine :adaug complexitate ciclomatica enorma (7) aici ~= nr de execution path pe care o poate lua codul
        // 7 ifuri => 7 teste
        return $config;
    }
}

// pazea ca bine bizu cu changeu: vrem doar major versiso in sessionId