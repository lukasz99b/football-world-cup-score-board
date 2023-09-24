<?php

declare(strict_types=1);

namespace App\ScoreBoard;

class Game
{
    private int $homeTeamScore = 0;
    private int $awayTeamScore = 0;

    public function __construct(
        public readonly string $homeTeamName,
        public readonly string $awayTeamName,
    ) {
    }

    public function getHomeTeamScore(): int
    {
        return $this->homeTeamScore;
    }

    public function getAwayTeamScore(): int
    {
        return $this->awayTeamScore;
    }
}