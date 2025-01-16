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

    public function setBeeList(array $beeList): void
    {
        $this->beeList = $beeList;
    }

    public function populate(): void
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

    public function hitRandomBee(): void
    {
        $beeWithLifeList = $this->getAliveBeeList();
        if(count($beeWithLifeList) > 0) {
            $bee = $beeWithLifeList[array_rand($beeWithLifeList)];
            $bee->gotHit();
        }
    }

    protected function getAliveBeeList(): array
    {
        return array_filter($this->beeList, function (Bee $bee) {
            return $bee->getHitPoints() > 0;
        });
    }



    public function procGameOverIfNeeded(): void
    {
        if($this->doesQueenIsDead()){
            $this->setAllBeeListHitPointsToZero();
        }
    }

    protected function doesQueenIsDead(): bool
    {
        $aliveQueenList = array_filter($this->beeList, function (Bee $bee) {
            return $bee->getType() === 'queen' && $bee->getHitPoints() > 0;
        });

        return count($aliveQueenList) === 0;
    }

    protected function setAllBeeListHitPointsToZero(): void
    {
        /** @var Bee $bee */
        foreach ($this->beeList as $bee) {
            $bee->setHitPoints(0);
        }
    }
}