<?php

namespace PhpUnitWorkshopTest;

class Address
{
    private $city;
    private $streetAddress;

    public function __construct(string $city, string $streetAddress)
    {
        $this->city = $city;
        $this->streetAddress = $streetAddress;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getStreetAddress(): string
    {
        return $this->streetAddress;
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
     * @param string $streetAddress
     * @return Address
     */
    public function setStreetAddress(string $streetAddress): Address
    {
        $this->streetAddress = $streetAddress;
        return $this;
    }
}