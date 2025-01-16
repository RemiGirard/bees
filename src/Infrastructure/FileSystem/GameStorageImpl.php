<?php

namespace App\Infrastructure\FileSystem;

use App\Entity\Bee;
use App\Entity\Game;
use App\Entity\BeeTypes\Queen;
use App\Entity\BeeTypes\Scout;
use App\Entity\BeeTypes\Worker;
use App\Manager\GameStorageInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Yaml\Yaml;

class GameStorageImpl implements GameStorageInterface
{
    protected string $gameFilePath;
    private Filesystem $filesystem;

    public function __construct(string $gameStorePath)
    {
        $this->gameFilePath = $gameStorePath;
        $this->filesystem = new Filesystem();
    }

    public function saveGame(Game $game): void
    {
        $dataToSerialize = array_map(function (Bee $bee) {
            return ['type' => $bee->getType(), 'hitPoints' => $bee->getHitPoints()];
        }, $game->getBeeList());

        $yamlData = Yaml::dump($dataToSerialize, 2, 2, Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK);

        $this->filesystem->dumpFile($this->gameFilePath, $yamlData);
    }

    public function getGame(): Game|null
    {
        if (!$this->filesystem->exists($this->gameFilePath)) {
            return null;
        }

        $beeDataArray = Yaml::parseFile($this->gameFilePath);
        $beeList = array_map(function (array $beeData) {
            return match ($beeData['type']) {
                'queen' => new Queen($beeData['hitPoints']),
                'worker' => new Worker($beeData['hitPoints']),
                'scout' => new Scout($beeData['hitPoints']),
                default => throw new \Exception("Unknown bee type '{$beeData['type']}'"),
            };
        }, $beeDataArray);

        $game = new Game();
        $game->setBeeList($beeList);

        return $game;
    }
}
