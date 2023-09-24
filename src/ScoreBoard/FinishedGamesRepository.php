<?php

declare(strict_types=1);

namespace App\ScoreBoard;

interface FinishedGamesRepository
{
    public function add(Game $game): void;

    public function all();
}
