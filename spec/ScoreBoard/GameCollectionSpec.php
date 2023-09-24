<?php

declare(strict_types=1);

namespace spec\App\ScoreBoard;

use App\ScoreBoard\Game;
use App\ScoreBoard\GameCollection;
use PhpSpec\ObjectBehavior;

class GameCollectionSpec extends ObjectBehavior
{
    public function it_is_initializable(): void
    {
        $this->shouldHaveType(GameCollection::class);
    }

    public function it_holds_games(): void
    {
        $game1 = new Game('Team1', 'Team2');
        $game2 = new Game('Team3', 'Team4');

        $this->add($game1);
        $this->add($game2);

        $this->toArray()->shouldReturn([
            $game1,
            $game2,
        ]);
    }
}
