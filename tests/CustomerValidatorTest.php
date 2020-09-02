<?php


namespace PhpUnitWorkshopTest;


use PHPUnit\Framework\TestCase;

class CustomerValidatorTest extends TestCase
{

    /** @test
     * @throws \Exception
     */
    public function first() {
        $validator = new CustomerValidator();
        $address = new Address("Bucharest", "Dristorului");
        $customer = new Customer("jdoe", $address);
        $validator->validate($customer);
    }
}