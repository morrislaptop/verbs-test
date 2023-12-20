<?php

namespace App;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Uid\AbstractUid;
use Thunk\Verbs\SerializedByVerbs;

/**
 * Using domain specific objects are better than Snowflakes.
 *
 * Extending AbstractUid to make it compatible with Verbs
 * (Verbs should have a client specific interface as an option)
 */
class PolicyNumber extends AbstractUid implements SerializedByVerbs
{
    public function __construct(string $policyNumber)
    {
        $this->uid = $policyNumber;
    }

    public static function isValid(string $uid): bool
    {
        return true;
    }

    public static function fromString(string $uid): static
    {
        return new static($uid);
    }

    public function toBinary(): string
    {
        return $this->uid;
    }

    public static function deserializeForVerbs(array $data, DenormalizerInterface $denormalizer): static
    {
        return new static($data['uid']);
    }

    public function serializeForVerbs(NormalizerInterface $normalizer): string|array
    {
        return ['uid' => $this->uid];
    }
}
