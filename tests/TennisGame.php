<?php


namespace PhpUnitWorkshopTest;


class TennisGame
{
    private $player1Points = 0;
    private $player2Points = 0;

    private const SCORE_TABLE = [
        0 => 'Love',
        1 => 'Fifteen',
        2 => 'Thirty',
        3 => 'Forty'];

    public function score(): string
    {
        if ($this->player1Points >= 4 && $this->player1Points - $this->player2Points >= 2) {
            return 'Game Won Player1';
        }
        if ($this->player1Points >= 3 && $this->player2Points >= 3) {
            if ($this->player1Points - $this->player2Points == 1) {
                return 'Advantage Player1';
            }
            if ($this->player2Points - $this->player1Points == 1) {
                return 'Advantage Player2';
            }
            if ($this->player1Points == $this->player2Points) {
                return 'Deuce';
            }
        }
        return sprintf("%s-%s",
            self::SCORE_TABLE[$this->player1Points],
            self::SCORE_TABLE[$this->player2Points]);
    }

    public function pointWon(int $playerId)
    {
        assert($playerId == 1 || $playerId == 2);
        if ($playerId == 1) {
            $this->player1Points++;
        } else {
            $this->player2Points++;
        }
    }

}