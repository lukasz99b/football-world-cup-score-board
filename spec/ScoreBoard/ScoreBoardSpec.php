<?php

declare(strict_types=1);

namespace spec\App\ScoreBoard;

use App\ScoreBoard\Exception\ScoreBoardException;
use App\ScoreBoard\Game;
use App\ScoreBoard\ScoreBoard;
use PhpSpec\ObjectBehavior;

class ScoreBoardSpec extends ObjectBehavior
{
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
}
