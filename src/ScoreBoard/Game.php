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

    public function updateScore(int $homeTeamScore, int $awayTeamScore): void
    {
        $this->homeTeamScore = $homeTeamScore;
        $this->awayTeamScore = $awayTeamScore;
    }

    public static function create(
        string $homeTeamName,
        int $homeTeamScore,
        string $awayTeamName,
        int $awayTeamScore
    ): static {
        $game = new static($homeTeamName, $awayTeamName);
        $game->updateScore($homeTeamScore, $awayTeamScore);
        return $game;
    }
}
