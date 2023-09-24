<?php

declare(strict_types=1);

namespace App\ScoreBoard;

class GameCollection
{
    private array $games = [];

    public function __construct(Game ...$games)
    {
        $this->games = $games;
    }

    public function add(Game $game): void
    {
        $this->games[] = $game;
    }

    public function toArray()
    {
        return $this->games;
    }
}
