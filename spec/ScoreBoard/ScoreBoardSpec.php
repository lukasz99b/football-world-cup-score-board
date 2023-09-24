<?php

declare(strict_types=1);

namespace spec\App\ScoreBoard;

use App\ScoreBoard\ScoreBoard;
use PhpSpec\ObjectBehavior;

class ScoreBoardSpec extends ObjectBehavior
{
    public function it_is_initializable(): void
    {
        $this->shouldHaveType(ScoreBoard::class);
    }
}
