<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 01-Aug-18
 * Time: 12:38 PM
 */

namespace PhpUnitWorkshop\mocks;


class TelemetryDiagnosticControls
{
    public const DIAGNOSTIC_CHANNEL_CONNECTION_STRING = '*111#';

    private $telemetryClient;
    private $diagnosticInfo = "";
    private $configProvider;

    public function __construct(TelemetryClient $telemetryClient, ConfigProvider $configProvider)
    {
        $this->telemetryClient = $telemetryClient;
        $this->configProvider = $configProvider;
    }

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
        while (!$this->telemetryClient->getOnlineStatus() && $currentRetry <= 3) {
            $this->telemetryClient->connect(self::DIAGNOSTIC_CHANNEL_CONNECTION_STRING);
            $currentRetry++;
        }

        if (!$this->telemetryClient->getOnlineStatus()) {
            throw new \Exception("Unable to connect.",13);
        }

        $this->telemetryClient->configure($this->configProvider->createConfig());

        $this->telemetryClient->send(TelemetryClient::DIAGNOSTIC_MESSAGE);

        $this->diagnosticInfo = $this->telemetryClient->receive();
    }
}
class ConfigProvider {
    public function createConfig(): TelemetryClientConfiguration
    {
        $config = new TelemetryClientConfiguration();
        $config->setSessionId(uniqid());
        $config->setSessionStart(time());
        $config->setAckMode(TelemetryClientConfiguration::ACK_NORMAL);
        return $config;
    }
}