<?php

declare(strict_types=1);

namespace spec\App\ScoreBoard;

use App\ScoreBoard\Exception\ScoreBoardException;
use App\ScoreBoard\FinishedGamesRepository;
use App\ScoreBoard\Game;
use App\ScoreBoard\GameCollection;
use App\ScoreBoard\ScoreBoard;
use App\ScoreBoard\SummaryReportGenerator;
use PhpSpec\ObjectBehavior;

class ScoreBoardSpec extends ObjectBehavior
{
    public function let(
        FinishedGamesRepository $repository,
        SummaryReportGenerator $report,
    ): void {
        $this->beConstructedWith($repository, $report);
    }

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(ScoreBoard::class);
    }

    public function it_can_start_the_game(): void
    {
        $this->startGame('Team1', 'Team2');

        $this->getGame()->shouldReturnAnInstanceOf(Game::class);

        $this->getGame()->homeTeamName->shouldReturn('Team1');
        $this->getGame()->awayTeamName->shouldReturn('Team2');
        $this->getGame()->getHomeTeamScore()->shouldReturn(0);
        $this->getGame()->getAwayTeamScore()->shouldReturn(0);
    }

    public function it_cannot_start_next_game_when_previous_is_not_finished(): void
    {
        $this->startGame('Team1', 'Team2');
        $this->shouldThrow(ScoreBoardException::class)
            ->during('startGame', ['Team3', 'Team4']);
    }

    public function it_can_finish_the_game(FinishedGamesRepository $repository): void
    {
        $this->startGame('Team1', 'Team2');
        $game = $this->getGame();
        $repository->add($game)->shouldBeCalled();

        $this->finishGame();

        $this->getGame()->shouldReturn(null);
    }

    public function it_can_update_score(): void
    {
        $this->startGame('Team1', 'Team2');
        $this->updateScore(1, 0);

        $this->getGame()->getHomeTeamScore()->shouldReturn(1);
        $this->getGame()->getAwayTeamScore()->shouldReturn(0);
    }

    public function it_can_generate_summary(
        FinishedGamesRepository $repository,
        SummaryReportGenerator $report,
    ): void {
        $gameCollection = new GameCollection();

        $repository->all()->willReturn($gameCollection);
        $report->generate($gameCollection);

        $this->getFinishedGamesSummary()->shouldBeString();
    }
}
