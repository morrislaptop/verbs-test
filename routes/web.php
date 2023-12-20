<?php

use App\BillingMethod;
use App\Events\PolicyBound;
use App\Events\PolicyCancelled;
use App\PolicyNumber;
use App\Support\LocalDate;
use App\Support\Money;
use App\Term;
use Brick\DateTime\Period;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/bind', function () {
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
});


Route::get('/cancel', function () {
    (new PolicyCancelled(
        policyNumber: new PolicyNumber('ABC123'),
        effectiveDate: LocalDate::of(2024, 01, 01),
    ))->fireThis();
});
