<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Mockery\MockInterface;
use PhpUnitWorkshopTest\BowlingScore;
use PhpUnitWorkshopTest\StringCalculator;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends \PHPUnit\Framework\TestCase implements Context
{
//    /** @var BowlingGameCuDependinte */
//    private $service;
//    /** @var ScoreProvider|MockInterface */
//    private $mockScoreProvider;
    /**
     * @When /^The score string is '(.*)'$/
     */
//    public function theScoreStringIs(string $inputScoreString)
//    {
//        $this->mockScoreProvider->shouldReceive("getScore")
//        ->andReturn($inputScoreString);
//    }

    private string $input;

    /**
     * @When /^Input is "([^"]*)"$/
     */
    public function inputIs(string $input)
    {
        $this->input = $input;
    }

    /**
     * @Then /^Add Output is (\d+)$/
     */
    public function outputIs(int $expected)
    {
        $calculator = new StringCalculator();
        self::assertEquals($expected, $calculator->Add($this->input));
    }
}
