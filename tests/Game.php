<?php

namespace PhpUnitWorkshopTest;


//class Round {}
class Game
{
    /** @var int[] */
    private array $pins = [];

    public function score(): int
    {
        $score = 0;
        for ($i = 0; $i < count($this->pins) - 1; $i += 2) {
            $score += $this->pins[$i] + $this->pins[$i+1];
            if ($this->pins[$i] + $this->pins[$i + 1] === 10) {
                if ($this->pins[$i] === 10)
                    $score += $this->pins[$i + 3];
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
        if ($pins == 10) {
            $this->pins[] = 0;
        }
    }
}