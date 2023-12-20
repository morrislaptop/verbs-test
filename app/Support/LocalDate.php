<?php

namespace App\Support;

class LocalDate implements ToFromArray
{
    use ToFromArrayVerbs;

    public function __construct(public int $year, public int $month, public int $day)
    {

    }

    public static function of(int $year, int $month, int $day)
    {
        return new static($year, $month, $day);
    }

    public function toArray(): array
    {
        return ['year' => $this->year, 'month' => $this->month, 'day' => $this->day];
    }

    public static function fromArray(array $data): static
    {
        return new static($data['year'], $data['month'], $data['day']);
    }
}
