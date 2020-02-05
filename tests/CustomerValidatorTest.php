<?php


namespace PhpUnitWorkshopTest;


use PHPUnit\Framework\TestCase;

class CustomerValidatorTest extends TestCase
{

    const CUST_NO_ADDRESS_CITY = 563;
    /**
     * @var Customer
     */
    private $customer;

    protected function setUp()
    {
        $this->customer = new Customer('John', new Address('Craiova', 'Unirea'));
    }

    public function testPassesForValidCustomer() {
        self::assertNull((new CustomerValidator())->validate($this->customer));
    }

    public function testThrowsForCustomerWithoutName() {
        $this->customer->setName('');
//        $this->expectExceptionMessage('Missing customer name'); // fragil
        $this->expectException(\Exception::class); // e prea vaga
        (new CustomerValidator())->validate($this->customer);
    }
    public function testThrowsForCustomerWithoutAddressCity() {
        $this->customer->getAddress()->setCity('');
//        $this->expectExceptionMessage('Missing address xcity'); // fragil
//        $this->expectException(\Exception::class); // e prea vaga
        $this->expectExceptionCode(self::CUST_NO_ADDRESS_CITY);
        (new CustomerValidator())->validate($this->customer);
    }
}