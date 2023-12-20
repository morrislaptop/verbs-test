<?php
namespace App\Support;

use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

trait ToFromArrayVerbs
{
    public static function deserializeForVerbs(array $data, DenormalizerInterface $denormalizer): static
    {
        return static::fromArray($data);
    }

    public function serializeForVerbs(NormalizerInterface $normalizer): string|array
    {
        return $this->toArray();
    }
}
