<?php
namespace App\Infrastructure\FileSystem;

use App\Entity\Bee;
use App\Entity\BeeTypes\Queen;
use App\Entity\BeeTypes\Worker;
use App\Entity\BeeTypes\Scout;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class BeeStoreNormalizer implements NormalizerInterface, DenormalizerInterface
{
    public function normalize($data, string $format = null, array $context = []): array
    {
        return [
            'type' => $data->getType(),
            'hitPoints' => $data->getHitPoints(),
        ];
    }

    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $data instanceof Bee;
    }

    public function supportsDenormalization($data, string $type, string $format = null, array $context = []): bool
    {
        return is_array($data) && isset($data['type']) && isset($data['hipoints']);
    }

    public function denormalize($data, string $type, string $format = null, array $context = []): Bee
    {
        switch ($data['type']) {
            case 'queen':
                return new Queen($data['hitpoints']);
            case 'worker':
                return new Worker($data['hitpoints']);
            case 'scout':
                return new Scout($data['hitpoints']);
            default:
                throw new \InvalidArgumentException("Unknown bee type");
        }
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            Queen::class => true,
            Worker::class => true,
            Scout::class => true,
        ];
    }
}
