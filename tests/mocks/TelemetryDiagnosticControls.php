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

    private TelemetryClient $telemetryClient;
    private TelemetryClientConfigFactory $configFactory;
    private $diagnosticInfo = "";
    public function __construct(TelemetryClient $telemetryClient, TelemetryClientConfigFactory $configFactory)
    {
        $this->telemetryClient = $telemetryClient;
        $this->configFactory = $configFactory;
    }

    public function getDiagnosticInfo(): String
    {
        return $this->diagnosticInfo;
    }

    public function setDiagnosticInfo(String $diagnosticInfo): void
    {
        $this->diagnosticInfo = $diagnosticInfo;
    }

    public function checkTransmission()
    {
        $this->telemetryClient->disconnect(); // OK

        $currentRetry = 1;
        while (!$this->telemetryClient->getOnlineStatus() && $currentRetry <= 3) {
            $this->telemetryClient->connect(self::DIAGNOSTIC_CHANNEL_CONNECTION_STRING);
            $currentRetry++;
        }

        if (!$this->telemetryClient->getOnlineStatus()) {
            throw new \Exception("Unable to connect."); // THIS
        }

        $config = $this->configFactory->createConfig($currentRetry);
        $this->telemetryClient->configure($config); // OK

        $this->telemetryClient->send(TelemetryClient::DIAGNOSTIC_MESSAGE);
        $this->diagnosticInfo = $this->telemetryClient->receive();
    }




}




class User {
    private $active = false;

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

}