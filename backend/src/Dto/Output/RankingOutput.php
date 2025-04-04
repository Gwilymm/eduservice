<?php

namespace App\Dto\Output;

class RankingOutput
{
    public int $rank;
    public string $ambassadorFullName;
    public int $points;
    public ?string $school = null;
    public ?string $schoolYear = null;
    public array $rewards = [];
}
