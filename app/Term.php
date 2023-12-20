<?php

namespace App;

use App\Support\LocalDate;
use Brick\DateTime\Period;

class Term
{
    public function __construct(
        public LocalDate $start,
        public Period $period,
    )
    {

    }
}
