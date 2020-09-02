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

    /** @test
     * @throws \Exception
     */
    public function first() {
        $this->validator->validate($this->aValidCustomer());
    }


    /** @test
     * @throws \Exception
     * @expectedException \Exception
     */
    public function throwsForCustomerWithEmptyName() {
        $this->validator->validate($this->aValidCustomer()->setCustomerName(""));
    }


    /** @test
     * @throws \Exception
     * @expectedException \Exception
     * @expectedExceptionMessage customer.address.city.missing
     */
    public function throwsForCustomerWithEmptyAddressCityName() {
        $customer = $this->aValidCustomer()
            ->setAddress($this->aValidAddress()->setCity(""));

        $this->validator->validate($customer);
    }

    /** @test
     * @throws \Exception
     * @expectedException \Exception
     * @expectedExceptionMessage customer.address.street.missing
     */
    public function throwsForCustomerWithEmptyAddressStreet() {
        $customer = $this->aValidCustomer()->setAddress($this->aValidAddress()->setStreetAddress(""));
        $this->validator->validate($customer);
    }




}