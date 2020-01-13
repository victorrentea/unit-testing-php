<?php


namespace PhpUnitWorkshopTest;


class CustomerValidator
{
    public function validate(Customer $customer)
    {
        if (empty($customer->getName())) {
            throw new EmagException("Missing customer name");
        }
        $this->validateAddress($customer->getAddress());
        //etc
    }

    private function validateAddress(Address $address)
    {
        if (empty($address->getCity())) {
            throw new EmagException('', 13);
        }
        if (empty($address->getStreetName())) {
            throw new EmagException("Missing street name",14);
        }
    }
}
