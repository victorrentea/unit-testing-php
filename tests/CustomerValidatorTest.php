<?php


namespace PhpUnitWorkshopTest;


use PHPUnit\Framework\TestCase;

class CustomerValidatorTest extends TestCase
{
    private $customerValidator;

    protected function setUp()
    {
        $this->customerValidator = new CustomerValidator();
    }

    public function testHappy() {
        $this->customerValidator -> validate($this->aValidCustomer());
    }

    public function testThrowsForCustomerWithEmptyName() {
        self::expectException(\Exception::class);
        $this->customerValidator -> validate($this->aValidCustomer()->setName(''));
    }

    public function testThrowsForCustomerWithNoAddressCity() {
        $customer = $this->aValidCustomer()
            ->setAddress($this->aValidAddress()->setCity(''));
        self::expectExceptionCode(13);
        $this->customerValidator -> validate($customer);
    }

    public function testThrowsForCustomerWithNoAddressStreetName() {
        $customer = $this->aValidCustomer()
            ->setAddress($this->aValidAddress()->setStreetName(''));
        self::expectExceptionCode(14);
        $this->customerValidator -> validate($customer);
    }

    public function aValidCustomer(): Customer
    {
        return (new Customer())
            ->setName('Nume')
            ->setAddress($this->aValidAddress());
    }

    public function aValidAddress(): Address
    {
        return (new Address())
            ->setCity('Iasi')
            ->setStreetName('Great Stephan');
    }
}