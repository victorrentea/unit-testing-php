<?php


namespace PhpUnitWorkshopTest;


use PHPUnit\Framework\TestCase;

class TennisGameTest extends TestCase
{

    public function getScoreForPoints(int $pointsPlayer1, int $pointsPlayer2): string
    {
        $tennisGame = new TennisGame();
        $this->pointsWonByPlayer($pointsPlayer1, 1, $tennisGame);
        $this->pointsWonByPlayer($pointsPlayer2, 2, $tennisGame);
        return $tennisGame->score();
    }

    public function pointsWonByPlayer(int $nPoints, int $playerId, TennisGame $tennisGame): void
    {
        for ($i = 0; $i < $nPoints; $i++) {
            $tennisGame->pointWon($playerId);
        }
    }

    /** @test */
    public function loveLove()
    {
        self::assertEquals('Love-Love', $this->getScoreForPoints(0,0));
    }

    /** @test */
    public function loveFifteen()
    {
        self::assertEquals('Love-Fifteen', $this->getScoreForPoints(0,1));
    }

    /** @test */
    public function fifteenLove()
    {
        self::assertEquals('Fifteen-Love', $this->getScoreForPoints(1,0));
    }

    /** @test */
    public function fifteenFifteen()
    {
        self::assertEquals('Fifteen-Fifteen', $this->getScoreForPoints(1,1));
    }

    /** @test */
    public function loveThirty()
    {
        self::assertEquals('Love-Thirty', $this->getScoreForPoints(0,2));
    }

    /** @test */
    public function loveForty()
    {
        self::assertEquals('Love-Forty', $this->getScoreForPoints(0,3));
    }

    /** @test */
    public function deuce()
    {
        self::assertEquals('Deuce', $this->getScoreForPoints(3, 3));
    }

    /** @test */
    public function deuce4()
    {
        self::assertEquals('Deuce', $this->getScoreForPoints(4,4));
    }
    /** @test */
    public function advantagePlayer1()
    {
        self::assertEquals('Advantage Player1',
            $this->getScoreForPoints(4,3));
    }
    /** @test */
    public function advantagePlayer1bis()
    {
        self::assertEquals('Advantage Player1',
            $this->getScoreForPoints(5,4));
    }
    /** @test */
    public function advantagePlayer2()
    {
        self::assertEquals('Advantage Player2',
            $this->getScoreForPoints(7,8));
    }
    /** @test */
    public function gameWon1_mar()
    {
        self::assertEquals('Game Won Player1',
            $this->getScoreForPoints(4,0));
    }
}