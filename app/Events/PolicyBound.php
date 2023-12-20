<?php

namespace App\Events;

use App\BillingMethod;
use App\PolicyNumber;
use App\States\PolicyState;
use App\Support\EventCannon;
use App\Support\Money;
use App\Term;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;
use Thunk\Verbs\Event;

class PolicyBound extends Event
{
    use EventCannon;

    public function __construct(
        #[StateId(PolicyState::class)]
        public PolicyNumber $policyNumber,
        public Money $premium,
        public Term $term,
        public BillingMethod $billingMethod,
        public int $renewalCount,
    ) { }

    public function validate(PolicyState $state)
    {
        return ! $state->isBound;
    }

    public function apply(PolicyState $state) {
        $state->isBound = true;
        $state->policyNumber = $this->policyNumber;
    }

    public function handle()
    {
        // It ain't my birthday but I got my name on the cake - Lil Wayne
    }
}
