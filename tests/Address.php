<?php

namespace PhpUnitWorkshopTest;

class Address
{
    /** @var string */
    private $city;
    /** @var string */
    private $streetName;

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Address
     */
    public function setCity(string $city): Address
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreetName(): string
    {
        return $this->streetName;
    }

    /**
     * @param string $streetName
     * @return Address
     */
    public function setStreetName(string $streetName): Address
    {
        $this->streetName = $streetName;
        return $this;
    }

}