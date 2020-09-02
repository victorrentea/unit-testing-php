<?php


namespace PhpUnitWorkshopTest;


class CustomerValidator
{
    /** @throws \Exception */
    public function validate(Customer $customer)
    {
        if ($customer->getName() == '') {
            throw new \Exception("Missing customer name");
        }
        $this->validateAddress($customer->getAddress());
//etc
    }

    /** @throws \Exception */
    private function validateAddress(Address $address)
    {
        if ($address->getCity() == '') {
            throw new \Exception("customer.address.city.missing");
        }
        if ($address->getStreetAddress() == '') {
            throw new \Exception("customer.address.street.missing");
        }
    }
}


//class CustomerWithoutAddressCityValidationError extends \Exception { }
//class CustomerWithoutNameValidationError extends \Exception { }
//class CustomerWithoutAddressCityValidationError extends \Exception { }
//class CustomerWithoutAddressCityValidationError extends \Exception { }

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

    public function setCustomerName(string $name)
    {
        $this->name = $name;
    }
}
