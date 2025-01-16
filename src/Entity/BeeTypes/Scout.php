<?php

namespace App\Entity\BeeTypes;

use App\Entity\Bee;

class Scout extends Bee
{
    public function __construct(int $hitPoints = 30) {
        parent::__construct('scout', $hitPoints, 15);
    }
}
