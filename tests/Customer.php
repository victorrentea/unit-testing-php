<?php

namespace PhpUnitWorkshopTest;

class Customer
{
    private $name;
    private $address;

    public function __construct(string $name, Address $address)
    {
        $this->name = $name;
        $this->address = $address;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Customer
     */
    public function setName(string $name): Customer
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param Address $address
     * @return Customer
     */
    public function setAddress(Address $address): Customer
    {
        $this->address = $address;
        return $this;
    }

}