<?php
namespace App\Support;

use Thunk\Verbs\SerializedByVerbs;

interface ToFromArray extends SerializedByVerbs
{
    public function toArray(): array;

    public static function fromArray(array $data): static;
}
