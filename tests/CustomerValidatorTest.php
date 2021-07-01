<?php


namespace PhpUnitWorkshopTest;


use PHPUnit\Framework\TestCase;

class BaseTest  extends TestCase {
    protected $validator;
    public function setUp(): void
    {
        parent::setUp();
        $this->validator = new CustomerValidator();
    }
}

class CustomerValidatorTest extends BaseTest
{
    private $customer;

    public function setUp(): void
    {
        parent::setUp();
        $this->customer = TestData::aCustomer();
    }

    /** @test */
    public function noExceptions_validCustomer() {
        // $this->init1();
        $this->validator->validate($this->customer);
    }

    /** @test */
    public function throwsForCustomerWithoutName() {
        $this->expectExceptionMessage("Missing customer name"); // vezi ca metoda asta tre sa se termine cu exceptie

        $this->customer->setName(null);

        $this->validator->validate($this->customer);

    }

    /** @test */
    public function throwsForNoCity() {
        // $this->expectException(\UserVisibleException::class);
        $this->expectExceptionMessage("Missing address city"); // vezi ca metoda asta tre sa se termine cu exceptie

        $this->customer->getAddress()->setCity(null);

        $this->validator->validate($this->customer);
    }

    /** @test */
    public function inAltaParte() {
        TestData::aCustomer()
            ->setName("Jiji")
            ->setEmail("a@b.com")
            ->setPhone("8989989");
    }

}
class TestData { // Object Mother pattern

    public static function aCustomer(): Customer
    {
        $customer = new Customer();
        $customer->setName("name");
        $address = new Address();
        $address->setCity("City");
        $customer->setAddress($address);
        return $customer;
    }
    public static function aCustomerGremini(): array
    {
        return [
            "name"=>'name',
            'address'=>[
                'city'=>"City"
            ]];
    }
}