<?php

use App\BillingMethod;
use App\Events\PolicyBound;
use App\Events\PolicyCancelled;
use App\PolicyNumber;
use App\States\PolicyState;
use App\Support\LocalDate;
use App\Support\Money;
use App\Term;
use Brick\DateTime\Period;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Thunk\Verbs\Examples\Subscriptions\Models\Plan;
use Thunk\Verbs\Examples\Subscriptions\Models\Report;
use Thunk\Verbs\Examples\Subscriptions\Models\User;
use Thunk\Verbs\Facades\Verbs;
use Thunk\Verbs\Lifecycle\StateManager;
use Thunk\Verbs\Models\VerbEvent;
use Thunk\Verbs\Models\VerbSnapshot;
use Thunk\Verbs\Models\VerbStateEvent;

uses(RefreshDatabase::class);

test('a policy can go through its lifecycle', function ()
{
    // Bind Policy.
    $policyBound = new PolicyBound(
        policyNumber: new PolicyNumber('ABC123'),
        premium: Money::of(50, 'AUD'),
        term: new Term(
            start: LocalDate::of(2023, 12, 20),
            period: Period::of(1, 0, 0),
        ),
        billingMethod: BillingMethod::Annually,
        renewalCount: 0,
    );
    $policyBound->fireThis();

    Verbs::commit();

    // dump(VerbEvent::first()->toArray());
    // dump(VerbSnapshot::first()->toArray());

    app(StateManager::class)->reset(true);
    $policy = PolicyState::load('ABC123');
    dump($policy);

    // Cancel Policy.
    (new PolicyCancelled(
        policyNumber: new PolicyNumber('ABC123'),
        effectiveDate: LocalDate::of(2024, 01, 01),
    ))->fireThis();

    Verbs::commit();

    app(StateManager::class)->reset(true);
    $policy = PolicyState::load('ABC123');
    dump($policy);

    // expect($daniel->active_subscriptions)->toHaveCount(2);

    // $silly_plan_subscription = $daniel->activeSubscription($silly_plan);
    // $serious_plan_subscription = $daniel->activeSubscription($serious_plan);

    // expect($silly_plan_subscription)->not->toBeNull();
    // expect($serious_plan_subscription)->not->toBeNull();

    // $daniel->activeSubscription($silly_plan)->cancel();

    // Verbs::commit();

    // $silly_plan_subscription = $daniel->activeSubscription($silly_plan);
    // $serious_plan_subscription = $daniel->activeSubscription($serious_plan);

    // expect($silly_plan_subscription)->toBeNull();
    // expect($serious_plan_subscription)->not->toBeNull();

    // $silly_plan->generateReport();
    // $serious_plan->generateReport();
    // Plan::generateGlobalReport();

    // Verbs::commit();

    // $global_report = Report::whereNull('plan_id')->sole();
    // $silly_report = Report::where('plan_id', $silly_plan->id)->sole();
    // $serious_report = Report::where('plan_id', $serious_plan->id)->sole();

    // expect($global_report->summary)->toBe('2 subscribe(s); 1 unsubscribe(s); 50% churn');
    // expect($silly_report->summary)->toBe('1 subscribe(s); 1 unsubscribe(s); 100% churn');
    // expect($serious_report->summary)->toBe('1 subscribe(s); 0 unsubscribe(s); 0% churn');
});
