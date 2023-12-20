<?php

namespace App\States;

use App\BillingMethod;
use App\PolicyNumber;
use App\Term;
use Brick\Money\Money;
use Thunk\Verbs\State;

class PolicyState extends State
{
    public bool $isBound = false;

    public PolicyNumber $policyNumber;

    public Term $term;

    public Money $premium;

    public int $renewalCount;

    public BillingMethod $billingMethod;
}
