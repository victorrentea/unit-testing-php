<?php


namespace PhpUnitWorkshopTest;


use PHPUnit\Framework\TestCase;

class StringCalculatorTest2 extends TestCase
{
    // const AVANTICART_ID =2;
    private $stringCalculator;

    public function setUp(): void
    {
        parent::setUp();
        $this->stringCalculator = new StringCalculator2();
    }

    /** @test */
    public function inputWithNegativeIntegers() {
        $this->expectExceptionMessage('There are negative numbers');
        $this->stringCalculator->add('1,-2,-5');
    }

    /**
     * @test
     */
    public function inputWithPositiveIntegers() {
        $sum = $this->stringCalculator->add('1,2')->sumPositive();

        $this->assertEquals(3, $sum);
    }

    /**
     * @test
     */
    public function inputWithPositiveIntegersExceedingLimit() {
        $this->assertEquals(55, $this->stringCalculator->add('1, 4, 20BlaBLa, sdg30, 1000')->sumPositive());
    }

    /**
     * @test
     */
    public function inputWithNegativeAndPositiveIntegers() {
        $this->expectExceptionMessage('negative');
        $this->stringCalculator->add('-1, 5000, 23');
    }

    /**
     * @test
     */
    public function inputWithMultipleDelimitersContainingNegativeAndPositiveIntegers() {
        $this->expectExceptionMessage('negative');
        $this->stringCalculator->add('//;\n1;2,etc-3');

    }

    /**
     * @test
     */
    public function inputWithMultipleDelimitersContainingPositiveIntegers() {
        $this->assertEquals(6, $this->stringCalculator->add('//[*][%]\n1*2%3')->sumPositive());
    }

    /**
     * @test
     */
    public function emptyInput() {
        $this->assertEquals(0, $this->stringCalculator->add(''));
    }

}