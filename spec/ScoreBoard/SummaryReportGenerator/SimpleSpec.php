<?php

declare(strict_types=1);

namespace spec\App\ScoreBoard\SummaryReportGenerator;

use App\ScoreBoard\Game;
use App\ScoreBoard\GameCollection;
use App\ScoreBoard\SummaryReportGenerator\Simple;
use PhpSpec\ObjectBehavior;

class SimpleSpec extends ObjectBehavior
{
    public function it_is_initializable(): void
    {
        $this->shouldHaveType(Simple::class);
    }

    public function it_implements_summary_report_generator_interface(): void
    {
        $this->shouldImplement('App\ScoreBoard\SummaryReportGenerator');
    }

    public function it_generates_summary_report(): void
    {
        $games = new GameCollection(
            Game::create('Team A', 2, 'Team B', 2),
            Game::create('Team C', 1, 'Team D', 0),
            Game::create('Team E', 2, 'Team F', 2),
        );

        $this->generate($games)->shouldReturn(
            "Team E 2 - Team F 2\n"
            . "Team A 2 - Team B 2\n"
            . "Team C 1 - Team D 0\n"
        );
    }
}
