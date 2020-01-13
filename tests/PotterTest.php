<?php


namespace PhpUnitWorkshopTest;


use PHPUnit\Framework\TestCase;

class PotterTest extends TestCase
{


    public static function data(): array
    {
        return [
            'one' => [[1], 8],
            '2 same' => [[1,1], 8+8],
            '3 same' => [[1,1,1], 8+8+8],
            '2 discount' => [[1,2], (8+8)*0.95],
            '2 discount + 1' => [[1,1,2], (8+8) * 0.95 + 8],
            '2 discount + 2 discount' => [[1,1,2,2], 2*(8+8)*0.95],
            '3 discount' => [[1,2,3], (8+8+8) * 0.9],
            '3 discount + 2 discount' => [[1,2,3, 2,3], (8+8+8) * 0.9 + (8+8)*0.95],
            '4 discount' => [[1,2,3,4], (8+8+8+8) * 0.8],
            '5 discount' => [[1,2,3,4,5], (8+8+8+8+8) * 0.75],
            't1' => [[1,1,2,2,3,3,4,5], 51.2],
        ];
    }

    /**
     * @test
     * @dataProvider data
     */
    public function tot(array $input, float $expectedPrice) {
        $this->assertEquals($expectedPrice, Potter::calculatePrice($input));
    }




}
