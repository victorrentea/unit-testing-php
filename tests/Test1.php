<?php


namespace PhpUnitWorkshopTest;


use PHPUnit\Framework\TestCase;

class Test1 extends TestCase
{

    private $uuid;

    public function __construct()
    {
        echo "Uaaa!!\n";
    }

    protected function setUp()
    {
    }

    /** @test */
    public function m() {
        $this->uuid = uniqid();
        echo $this->uuid;
        self::assertTrue(true);
    }
    /** @test */
    public function m2() {
        echo 'hmm' . $this->uuid;
        self::assertTrue(true);
    }

}