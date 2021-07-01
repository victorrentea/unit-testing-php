<?php


namespace PhpUnitWorkshopTest;


class TennisScore
{
    const PLAYER_ONE = 1;
    const PLAYER_TWO = 2;
    private const LABELS = [0 => "Love", 1 => "Fifteen", 2=>"Thirty", 3=>"Forty"];

    private $player1Score = 0;
    private $player2Score = 0;

    function getScore(): string
    {
        if ($this->player1Score >= 3 &&
            // $this->player2Score >= 3 &&
            $this->player2Score == $this->player1Score) {
            return "Deuce";
        }
        return self::LABELS[$this->player1Score] . " - " . self::LABELS[$this->player2Score];
    }

    public function winPoint(int $playerNo)
    {
        if ($playerNo == 2) {
            $this->player2Score++;
        } else {
            $this->player1Score++;
        }
    }

}
