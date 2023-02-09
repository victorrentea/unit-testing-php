<?php

namespace PhpUnitWorkshopTest\design\fixturecreep;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class FastFoodTest extends TestCase
{
    private Dependency|MockObject $dependency;
    private FastFood $fastFood;

    public function setUp():void
    {
        $this->dependency = $this->createMock(Dependency::class);
        $this->fastFood = new FastFood($this->dependency);
        $this->dependency->method('isOnionAllowed')->willReturn(true);
        $this->dependency->method('isCucumberAllowed')->willReturn(true);
    }


    function testShawarma(): void
    {
        $shawarma = $this->fastFood->makeShawarma();
        assertEquals("Yummy Shawarma", $shawarma);
        // + 7 teste !!!!!
    }

    function testTzatziki(): void
    {
        $tzatziki = $this->fastFood->makeTzatziki();
        assertEquals("Cold Tzatziki", $tzatziki);
        // + 7 teste
    }

}