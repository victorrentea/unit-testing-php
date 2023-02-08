<?php

namespace PhpUnitWorkshopTest;

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class GameTest extends TestCase
{

    function testInitialGame(): void
    {
        $game = new Game();
        assertEquals(0 , $game->score());
    }

//    /** @runInSeparateProcess */
    function testOne(): void
    {
        $game = new Game();
        $game->roll(1);
        assertEquals(0 , $game->score());
    }
//    function testOneZero(): void
//    {
//        $game = new Game();
//        $game->roll(1);
//        assertEquals(1 , $game->score());
//    }
    function testOneOne(): void
    {
        $game = new Game();
        $game->roll(1);
        $game->roll(1);

        assertEquals(2 , $game->score());
    }

    function testSpare(): void
    {
        $game = new Game();
        $game->roll(7);
        $game->roll(3);
        $game->roll(2);
        $game->roll(0);

        assertEquals(12 + 2 , $game->score());
    }

    function testOneSpareLater(): void
    {
        $game = new Game();
        $game->roll(1);
        $game->roll(4);
        $game->roll(7);
        $game->roll(3);
        $game->roll(3);
        $game->roll(0);

        assertEquals(5 + 10 + 3 + 3 , $game->score());
    }
    function testSparePendingBonus(): void
    {
        $game = new Game();
        $game->roll(1);
        $game->roll(4);
        $game->roll(7);
        $game->roll(3);

        assertEquals(5 , $game->score());
    }
    function testStrike(): void
    {
        $game = new Game();
        $game->roll(10);
        $game->roll(1);
        $game->roll(1);
        assertEquals(12 + 2 , $game->score());
    }
//    function testStrikeZero(): void
//    {
//        $game = new Game();
//        $game->roll(10);
//        $game->roll(1);
//        assertEquals(0 , $game->score());
//    }

    function testStrikeIncomplet(): void
    {
        $game = new Game();
        $game->roll(10);
        $game->roll(1);
        assertEquals(0 , $game->score());
    }
    function spareCu10(): void
    {
        $game = new Game();
        $game->roll(0);
        $game->roll(10);
        $game->roll(1);
        assertEquals(11 , $game->score());
    }
    function spareNUmaistiucumsatechem_vatrebunDataProvider(): void
    {
        $game = new Game();
        $game->roll(0);
        $game->roll(10);
        $game->roll(1);
        $game->roll(1);
        assertEquals(13 , $game->score());
    }

//    function testBlanaTODO(): void
//    {
//        $game = new Game();
//        for ($i = 0;$i<12;$i++)
//            $game->roll(10);
//        assertEquals(300 , $game->score());
//    }
}