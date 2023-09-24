<?php

declare(strict_types=1);

namespace App\ScoreBoard;

use App\ScoreBoard\Exception\ScoreBoardException;

class ScoreBoard
{
    private ?Game $game = null;

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function startGame(string $homeTeamName, string $awayTeamName): void
    {
        if ($this->game !== null) {
            throw ScoreBoardException::gameAlreadyStarted();
        }

        $this->game = new Game($homeTeamName, $awayTeamName);
    }
}
