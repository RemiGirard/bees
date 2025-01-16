<?php

namespace App\Entity\BeeTypes;

use App\Entity\Bee;

class Queen extends Bee
{
    public function __construct(int $hitPoints = 100) {
        parent::__construct('queen', $hitPoints, 15);
    }
}
