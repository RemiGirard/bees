<?php

namespace App\Entity\BeeTypes;

use App\Entity\Bee;

class Scout extends Bee
{
    public function __construct() {
        parent::__construct('scout', 30, 15);
    }
}
