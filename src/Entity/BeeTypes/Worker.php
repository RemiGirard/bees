<?php

namespace App\Entity\BeeTypes;

use App\Entity\Bee;

class Worker extends Bee
{
    public function __construct() {
        parent::__construct('worker', 50, 20);
    }
}
