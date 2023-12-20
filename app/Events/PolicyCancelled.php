<?php

namespace App\Events;

use App\PolicyNumber;
use App\States\PolicyState;
use App\Support\EventCannon;
use App\Support\LocalDate;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;
use Thunk\Verbs\Event;

class PolicyCancelled extends Event
{
    use EventCannon;

    public function __construct(
        #[StateId(PolicyState::class)]
        public PolicyNumber $policyNumber,
        public LocalDate $effectiveDate,
    )
    { }

    public function validate(PolicyState $state)
    {
        return $state->isBound;
    }

    public function apply(PolicyState $state)
    {
        $state->isBound = false;
    }

    public function handle()
    {
        // Most of yall don't get the picture unless the flash is on. - Lil Wayne
    }
}
