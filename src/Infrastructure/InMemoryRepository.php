<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\ScoreBoard\FinishedGamesRepository;
use App\ScoreBoard\Game;
use App\ScoreBoard\GameCollection;

class InMemoryRepository implements FinishedGamesRepository
{
    private GameCollection $games;

    public function __construct()
    {
        $this->games = new GameCollection();
    }

    public function add(Game $game): void
    {
        $this->games->add($game);
    }

    public function all(): GameCollection
    {
        return $this->games;
    }
}
