<?php

namespace PhpUnitWorkshopTest;


//class Round {}
class Game
{
    /** @var int[] */
    private array $pins = [];


    public function score(): int
    {
        $score = array_sum($this->pins);
        for ($i = 0; $i < count($this->pins) - 1; $i+=2) {
            if ($this->pins[$i] + $this->pins[$i+1] === 10) {
                if (isset($this->pins[$i + 2]))
                    $score += $this->pins[$i + 2];
                else {
                    return $score - 10;
                }
            }
        }
        return $score;
    }

    public function roll(int $pins)
    {
        $this->pins[] = $pins;
    }
}