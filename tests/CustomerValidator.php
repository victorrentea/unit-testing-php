<?php


namespace PhpUnitWorkshopTest;


class CustomerValidator
{

    public function validate(Customer $customer)
    {
        if ($customer->getName() == '') {
            throw new \Exception("Missing customer name");
        }
        $this->validateAddress($customer->getAddress());
//etc
    }

    private function validateAddress(Address $address)
    {
        if ($address->getCity()) {
            throw new \Exception("Missing address xcity");
        }
    }
}

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
}

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
}
