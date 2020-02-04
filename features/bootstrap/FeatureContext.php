<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Mockery\MockInterface;
use PhpUnitWorkshopTest\BowlingScore;
use PhpUnitWorkshopTest\TennisGame;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends \PHPUnit\Framework\TestCase implements Context
{
    /** @var TennisGame */
    private $tennisGame;

    /**
     * @Given /^A new game$/
     */
    public function aNewGame()
    {
        $this->tennisGame = new TennisGame();
    }

    /**
     * @Then /^Score is "([^\"]+)"$/
     */
    public function scoreIs(string $expectedScoreString)
    {
        $score = $this->tennisGame->score();
        self::assertEquals($expectedScoreString, $score, "Actual = " . $score);
    }

    /**
     * @When /^Player(\d) scores one point$/
     */
    public function playerscoresOnePoint(int $playerId)
    {
        $this->tennisGame->pointWon($playerId);
    }

    /**
     * @When /^Player(\d) scores (\d+) points$/
     */
    public function playerScoresPoints(int $playerId, int $points)
    {
        for ($i = 0; $i < $points; $i++) {
            $this->tennisGame->pointWon($playerId);
        }
    }
}
