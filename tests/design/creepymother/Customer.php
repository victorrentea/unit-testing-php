<?php

namespace PhpUnitWorkshopTest\design\creepymother;

class Customer
{
    private string $name;
    private string $shippingAddress;
    private string $billingAddress;
    // + 20 more fields

    public function __construct(string $name, string $shippingAddress, string $billingAddress)
    {
        $this->name = $name;
        $this->shippingAddress = $shippingAddress;
        $this->billingAddress = $billingAddress;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Customer
    {
        $this->name = $name;
        return $this;
    }

    public function getShippingAddress(): string
    {
        return $this->shippingAddress;
    }

    public function setShippingAddress(string $shippingAddress): Customer
    {
        $this->shippingAddress = $shippingAddress;
        return $this;
    }

    public function getBillingAddress(): string
    {
        return $this->billingAddress;
    }

    public function setBillingAddress(string $billingAddress): Customer
    {
        $this->billingAddress = $billingAddress;
        return $this;
    }



}