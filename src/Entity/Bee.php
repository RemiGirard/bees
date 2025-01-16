<?php

namespace App\Entity;

abstract class Bee
{
    protected string $type;
    protected int $hitPoints;
    protected int $pointsLostOnHit;

    public function __construct(string $type, int $hitPoints, int $pointsLostOnHit)
    {
        $this->type = $type;
        $this->hitPoints = $hitPoints;
        $this->pointsLostOnHit = $pointsLostOnHit;
    }

    public function getHitPoints(): int
    {
        return $this->hitPoints;
    }

    public function setHitPoints(int $hitPoints): void
    {
        $this->hitPoints = $hitPoints;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function gotHit(): void
    {
        $this->hitPoints = max(0, $this->hitPoints - $this->pointsLostOnHit);
    }
}