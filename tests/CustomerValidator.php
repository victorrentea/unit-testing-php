<?php


namespace PhpUnitWorkshopTest;


class CustomerValidator
{
    public function __construct(stuff)
    {
    }

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
        if (empty($address->getCity())) {
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

    public function setCity(string $city): Address
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @param string $streetAddress
     */
    public function setStreetAddress(string $streetAddress): Address
    {
        $this->streetAddress = $streetAddress;
        return $this;
    }
}

class Customer
{
    private String $name;
    private $address;
    /** @var array Phone[]  */
    private array $phones;

    public function __construct(string $name, Address $address)
    {
        $this->name = $name;
        $this->address = $address;
    }

//    public function addPhone(Phone phone)


    /**
     * @param Address $address
     */
    public function setAddress(Address $address): Customer
    {
        $this->address = $address;
        return $this;
    }
    public function getAddress(): Address
    {
        return $this->address;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setCustomerName(string $name): Customer
    {
        $this->name = $name;
        return $this;
    }
}
