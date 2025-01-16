<?php

namespace App\Manager;

use App\Entity\Game;

interface GameStorageInterface
{
    public function saveGame(Game $game): void;
}
