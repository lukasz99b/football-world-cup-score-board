<?php

declare(strict_types=1);

namespace App\ScoreBoard;

use App\ScoreBoard\Exception\ScoreBoardException;

class ScoreBoard
{
    private ?Game $game = null;

    public function __construct(
        private readonly FinishedGamesRepository $finishedGamesRepository,
    ) {
    }

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

    public function finishGame()
    {
        if ($this->game === null) {
            throw ScoreBoardException::gameNotStarted();
        }

        $this->finishedGamesRepository->add($this->game);
        $this->game = null;
    }

    public function updateScore(int $homeTeamScore, int $awayTeamScore): void
    {
        if ($this->game === null) {
            throw ScoreBoardException::gameNotStarted();
        }

        $this->game->updateScore($homeTeamScore, $awayTeamScore);
    }
}
