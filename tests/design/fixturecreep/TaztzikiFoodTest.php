<?php

namespace PhpUnitWorkshopTest\design\fixturecreep;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class TaztzikiFoodTest extends TestCase
{
    private Dependency|MockObject $dependency;
    private TzatzikiFood $fastFood;

    public function setUp():void
    {
        $this->dependency = $this->createMock(Dependency::class);
        $this->fastFood = new TzatzikiFood($this->dependency);
        // daca repet 2 => la fel cu si fara expects(self::any())
        $this->dependency->expects(self::any())->method('isCucumberAllowed')->willReturn(true);
        // e ok sa nu o chemi 0
        $this->dependency->expects(self::any())->method('isOnionAllowed')->willReturn(true);
    }


    function testTzatziki(): void
    {
        $tzatziki = $this->fastFood->makeTzatziki();
        assertEquals("Cold Tzatziki", $tzatziki);
        // + 7 teste
    }

}