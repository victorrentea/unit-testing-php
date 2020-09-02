<?php


namespace PhpUnitWorkshopTest;


use PHPUnit\Framework\TestCase;

class CustomerValidatorTest extends TestCase
{

    private CustomerValidator $validator;
    private Address $address;
    private Customer $customer;
    private int $x = 1;


    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        echo "Uaaaa Uaaa!\n";
    }

    protected function setUp()
    {
        $this->validator = new CustomerValidator();
        $this->address = new Address("Bucharest", "Dristorului");
        $this->customer = new Customer("jdoe", $this->address);
    }

    /** @test
     * @throws \Exception
     * @expectedException \Exception
     */
    public function throwsForCustomerWithEmptyName() {
        $this->x = 2;
        $this->customer->setCustomerName("");

        $this->validator->validate($this->customer);
    }

    /** @test
     * @throws \Exception
     */
    public function first() {
        $this->validator->validate($this->customer);
        self::assertEquals(1, $this->x);
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