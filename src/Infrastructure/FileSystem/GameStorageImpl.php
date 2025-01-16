<?php

namespace App\Infrastructure\FileSystem;

use App\Entity\Bee;
use App\Entity\Game;
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
}
