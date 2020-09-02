<?php


namespace PhpUnitWorkshopTest;


use PHPUnit\Framework\TestCase;

class CustomerValidatorTest extends TestCase
{

    private CustomerValidator $validator;

    protected function setUp()
    {
        $this->validator = new CustomerValidator();
    }

    /** @test
     * @throws \Exception
     */
    public function first() {
        $address = new Address("Bucharest", "Dristorului");
        $customer = new Customer("jdoe", $address);
        $this->validator->validate($customer);
    }

    /** @test
     * @throws \Exception
     * @expectedException \Exception
     */
    public function throwsForCustomerWithEmptyName() {
        $address = new Address("Bucharest", "Dristorului");
        $customer = new Customer("", $address);
        $this->validator->validate($customer);
    }


    /** @test
     * @throws \Exception
     * @expectedException \Exception
     * @expectedExceptionMessage customer.address.city.missing
     */
    public function throwsForCustomerWithEmptyAddressCityName() {
        $address = new Address("", "Dristorului");
        $customer = new Customer("jjjj", $address);
        $this->validator->validate($customer);
    }

    /** @test
     * @throws \Exception
     * @expectedException \Exception
     * @expectedExceptionMessage customer.address.street.missing
     */
    public function throwsForCustomerWithEmptyAddressStreet() {
        $address = new Address("City", "");
        $customer = new Customer("Name", $address);
        $this->validator->validate($customer);
    }


}