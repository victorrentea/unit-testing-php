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

    /** @test
     * @throws \Exception
     * @expectedException \Exception
     */
//    public function customerAndThisAndThatWithEmptyName_isRejected() {
    public function throwsForCustomerWithEmptyName() {
        $validator = new CustomerValidator();
        $address = new Address("Bucharest", "Dristorului");
        $customer = new Customer("", $address);
        $validator->validate($customer);
    }


    /** @test
     * @throws \Exception
     * @expectedException \PhpUnitWorkshopTest\CustomerWithoutAddressCityValidationError
     */
//    public function customerAndThisAndThatWithEmptyName_isRejected() {
    public function throwsForCustomerWithEmptyAddressCityName() {
        $validator = new CustomerValidator();
        $address = new Address("", "Dristorului");
        $customer = new Customer("", $address);
        $validator->validate($customer);
    }


}