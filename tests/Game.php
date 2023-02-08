<?php

namespace PhpUnitWorkshopTest;


class Game
{
    /** @var int[] */
    private array $pins = [];

    public function score(): int
    {
        $score = 0;
        for ($i = 0; $i < count($this->pins) - 1; $i += 2) {
            $framePins = $this->pins[$i] + $this->pins[$i + 1];

            if ($framePins != 10) { // spare sau strike dar nu s-a terminat
                $score += $framePins;
            }
            if ($this->isSpare($framePins, $i) && isset($this->pins[$i + 2])) // spare
                $score += $framePins + $this->pins[$i + 2];

            if ($this->isStrike($framePins, $i) && isset($this->pins[$i + 2]) && isset($this->pins[$i + 3])) // strike
                $score += $framePins + $this->pins[$i + 2] + $this->pins[$i + 3];
        }
        return $score;
    }

    public function roll(int $pins)
    {
        $this->pins[] = $pins;
        if ($pins == 10 && count($this->pins)%2 == 1) {
            $this->pins[] = 0;
        }
    }

    public function isSpare(int $framePins, int $i): bool
    {
        return $framePins === 10 && ($this->pins[$i]) != 10;
    }

    public function isStrike(int $framePins, int $i): bool
    {
        return $framePins === 10 && $this->pins[$i] === 10;
    }
}