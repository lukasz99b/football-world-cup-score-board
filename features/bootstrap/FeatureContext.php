<?php

declare(strict_types=1);

namespace Features;

use App\Infrastructure\InMemoryRepository;
use App\ScoreBoard\ScoreBoard;
use App\ScoreBoard\SummaryReportGenerator\Simple;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private ScoreBoard $scoreBoard;
    private string $report;

    public function __construct()
    {
        $this->scoreBoard = new ScoreBoard(
            new InMemoryRepository(),
            new Simple(),
        );
    }

    /**
     * @Given /^the following matches were already played:$/
     */
    public function theFollowingMatchesWerePlayed(TableNode $table)
    {
        foreach ($table as $row) {
            $this->scoreBoard->startGame($row['Home team'], $row['Away team']);
            $this->scoreBoard->updateScore((int) $row['Home goals'], (int) $row['Away goals']);
            $this->scoreBoard->finishGame();
        }
    }

    /**
     * @When /^I ask for the summary report$/
     */
    public function iAskForTheSummaryReport()
    {
        $this->report = $this->scoreBoard->getFinishedGamesSummary();
    }

    /**
     * @Then /^I should receive$/
     */
    public function iShouldReceive(PyStringNode $string)
    {
        assert(trim($this->report) === $string->getRaw());
    }
}
