<?php


namespace PhpUnitWorkshopTest;


class CustomerValidator
{

    public function validate($customer)
    {
        if ($customer->getName() == '') {
            throw new UserVisibleException("Missing customer name");
        }
        $this->validateAddress($customer->getAddress());
    }

    private function validateAddress(Address $address)
    {
        if (!$address->getCity()) {
            throw new UserVisibleException("Missing address city");
        }
    }
}




class Address
{
    private $city;
    private $streetAddress;

    /**
     * @param mixed $city
     */
    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    /**
     * @param mixed $streetAddress
     */
    public function setStreetAddress(string $streetAddress): void
    {
        $this->streetAddress = $streetAddress;
    }
    public function getCity(): ?string
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
    private $phone;
    private $email;
    private $address;

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     * @return Customer
     */
    public function setPhone($phone):Customer
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email): Customer
    {
        $this->email = $email;
        return $this;
    }


    public function setName(?string $name): Customer
    {
        $this->name = $name;
        return $this;
    }

    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }
    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
