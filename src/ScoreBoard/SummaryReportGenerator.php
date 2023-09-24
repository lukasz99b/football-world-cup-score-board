<?php

declare(strict_types=1);

namespace App\ScoreBoard;

interface SummaryReportGenerator
{
    public function generate(GameCollection $games): string;
}
