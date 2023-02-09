<?php

namespace PhpUnitWorkshopTest;

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class GameTest extends TestCase
{
    private Game $game;

    protected function setUp(): void
    {
        echo "pt fiecare test un nou setup";
        $this->game = new Game();
    }

    function testInitialGame(): void
    {
        assertEquals(0 , $this->game->score());
    }

//    /** @runInSeparateProcess */
    function testOne(): void
    {
        $this->game->roll(1);
        assertEquals(0 , $this->game->score());
    }
//    function testOneZero(): void
//    {
//        $this->game->roll(1);
//        assertEquals(1 , $this->game->score());
//    }
    function testOneOne(): void
    {
        $this->game->roll(1);
        $this->game->roll(1);

        assertEquals(2 , $this->game->score());
    }

    function testSpare(): void
    {
        $this->game->roll(7);
        $this->game->roll(3);
        $this->game->roll(2);
        $this->game->roll(0);

        assertEquals(12 + 2 , $this->game->score());
    }

    function testOneSpareLater(): void
    {
        $this->game->roll(1);
        $this->game->roll(4);
        $this->game->roll(7);
        $this->game->roll(3);
        $this->game->roll(3);
        $this->game->roll(0);

        assertEquals(5 + 10 + 3 + 3 , $this->game->score());
    }
    function testSparePendingBonus(): void
    {
        $this->game->roll(1);
        $this->game->roll(4);
        $this->game->roll(7);
        $this->game->roll(3);

        assertEquals(5 , $this->game->score());
    }
    function testStrike(): void
    {
        $this->game->roll(10);
        $this->game->roll(1);
        $this->game->roll(1);
        assertEquals(12 + 2 , $this->game->score());
    }
//    function testStrikeZero(): void
//    {
//        $this->game->roll(10);
//        $this->game->roll(1);
//        assertEquals(0 , $this->game->score());
//    }

    function testStrikeIncomplet(): void
    {
        $this->game->roll(10);
        $this->game->roll(1);
        assertEquals(0 , $this->game->score());
    }
    function spareCu10(): void
    {
        $this->game->roll(0);
        $this->game->roll(10);
        $this->game->roll(1);
        assertEquals(11 , $this->game->score());
    }
    function spareNUmaistiucumsatechem_vatrebunDataProvider(): void
    {
        $this->game->roll(0);
        $this->game->roll(10);
        $this->game->roll(1);
        $this->game->roll(1);
        assertEquals(13 , $this->game->score());
    }

//    function testBlanaTODO(): void
//    {
//        $this->game = new Game();
//        for ($i = 0;$i<12;$i++)
//            $this->game->roll(10);
//        assertEquals(300 , $this->game->score());
//    }
}