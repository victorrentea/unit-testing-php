<?php


namespace PhpUnitWorkshopTest;


class CustomerValidator
{

    public function validate(Customer $customer)
    {
        if ($customer->getName() == '') {
            throw new \Exception("Missing Customer Name");
        }
        $this->validateAddress($customer->getAddress());
//etc
    }

    private function validateAddress(Address $address)
    {
        if ($address->getCity() == '') {
            throw new \Exception("Missing address city", 563);
        }
    }
}

//abuziv: o faci doar daca chiar o prinzi selectiv
class CustomerWithNoNameException extends \Exception {

}