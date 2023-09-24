<?php

namespace spec\App\ScoreBoard;

use App\ScoreBoard\Game;
use PhpSpec\ObjectBehavior;

class GameSpec extends ObjectBehavior
{
    public function let(): void
    {
        $this->beConstructedWith('Team1', 'Team2');
    }

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(Game::class);
    }

    public function it_holds_game_data(): void
    {
        $this->homeTeamName->shouldReturn('Team1');
        $this->awayTeamName->shouldReturn('Team2');
        $this->getHomeTeamScore()->shouldReturn(0);
        $this->getAwayTeamScore()->shouldReturn(0);
    }
}
