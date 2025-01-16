<?php

namespace App\Entity\BeeTypes;

use App\Entity\Bee;

class Queen extends Bee
{
    public function __construct() {
        parent::__construct('queen', 100, 15);
    }
}
