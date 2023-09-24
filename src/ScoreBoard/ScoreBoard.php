<?php

declare(strict_types=1);

namespace App\ScoreBoard;

class ScoreBoard
{
    private ?Game $game = null;

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function startGame(string $homeTeamName, string $awayTeamName): void
    {
        $this->game = new Game($homeTeamName, $awayTeamName);
    }
}
