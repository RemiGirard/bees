<?php

namespace App\Entity\BeeTypes;

use App\Entity\Bee;

class Worker extends Bee
{
    public function __construct(int $hitPoints = 50) {
        parent::__construct('worker', $hitPoints, 20);
    }
}
