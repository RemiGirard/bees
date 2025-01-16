<?php

namespace App\Entity;

use App\Entity\BeeTypes\Queen;
use App\Entity\BeeTypes\Scout;
use App\Entity\BeeTypes\Worker;

class Game
{
    protected array $beeList = [];

    public function getBeeList(): array
    {
        return $this->beeList;
    }

    public function __construct()
    {
        $this->beeList = $this->createBeePopulation([
            ['class' => Queen::class, 'count' => 1],
            ['class' => Worker::class, 'count' => 5],
            ['class' => Scout::class, 'count' => 8],
        ]);
    }

    protected function createBeePopulation(array $beeTypeList): array
    {
        $beeList = [];
        foreach ($beeTypeList as $beeType) {
            for ($i = 0; $i < $beeType['count']; $i++) {
                $beeList[] = new $beeType['class']();
            }
        }
        return $beeList;
    }
}