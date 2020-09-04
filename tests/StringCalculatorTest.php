<?php


namespace PhpUnitWorkshopTest;


use PHPUnit\Framework\TestCase;

class StringCalculatorTest extends TestCase
{
    private $stringCalculator;

    public function testReturnsZeroForEmptyString()
    {
        self::assertEquals(0, $this->stringCalculator->Add(""));
    }

    public function testReturns1ForString1()
    {
        self::assertEquals(1, $this->stringCalculator->Add("1"));
    }

    public function testReturns3ForString1_2()
    {
        self::assertEquals(3, $this->stringCalculator->Add("1,2"));
    }

    public function testReturns7ForString1_2_4()
    {
        self::assertEquals(7, $this->stringCalculator->Add("1,2,4"));
    }

    public function testReturns7ForStringMany()
    {
        self::assertEquals(7, $this->stringCalculator->Add("1,1,1,1,1,1,1"));
    }

    public function testNewLine()
    {
        self::assertEquals(3, $this->stringCalculator->Add("1\n2"));
    }

    public function testNewLine6()
    {
        self::assertEquals(6, $this->stringCalculator->Add("1\n2,3"));
    }

    public function testDynamicSeparator()
    {
        self::assertEquals(3, $this->stringCalculator->Add("//;\n1;2"));
    }

    public function testDynamicSeparatorNumber()
    {
        self::assertEquals(7, $this->stringCalculator->Add("//1\n212\n3"));
    }

    public function testDynamicSeparatorNumber22()
    {
        self::assertEquals(4, $this->stringCalculator->Add("//abc\n1abc3"));
    }

    public function testMultiCharDelimiterEndingInEnter()
    {
//        $input = <<< TXT
//        1,
//        2,
//        3,
//        TXT;
//        echo $input;

        self::assertEquals(3, $this->stringCalculator->Add("//*\n\n1*\n2"));
    }

    /**
     * @test
     * @expectedException \Exception
     * @expectedExceptionMessage -1,-2
     */
    public function testThrowsForNegatives()
    {
        $this->stringCalculator->Add("0,-1,3,-2");
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->stringCalculator = new StringCalculator();
    }
}
