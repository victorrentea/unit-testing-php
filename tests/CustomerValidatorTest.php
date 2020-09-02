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

    private function aValidCustomer(): Customer
    {
        return new Customer("jdoe", $this->aValidAddress());
    }
    private function aValidAddress(): Address
    {
        return new Address("Bucharest", "Dristorului");
    }

    /**
     * @throws \Exception
     */
    public function testValid() {
        $this->validator->validate($this->aValidCustomer());
    }


    /**
     * @throws \Exception
     * @expectedException \Exception
     */
    public function testThrowsForCustomerWithEmptyName() {
        $this->validator->validate($this->aValidCustomer()->setCustomerName(""));
    }


    /**
     * @throws \Exception
     * @expectedException \Exception
     * @expectedExceptionMessage customer.address.city.missing
     */
    public function testThrowsForCustomerWithEmptyAddressCityName() {
        $customer = $this->aValidCustomer()
            ->setAddress($this->aValidAddress()->setCity(""));

        $this->validator->validate($customer);
    }

    /**
     * @throws \Exception
     * @expectedException \Exception
     * @expectedExceptionMessage customer.address.street.missing
     */
    public function testThrowsForCustomerWithEmptyAddressStreet() {
        $customer = $this->aValidCustomer()->setAddress($this->aValidAddress()->setStreetAddress(""));
        $this->validator->validate($customer);
    }




}