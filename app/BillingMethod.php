<?php

namespace App;

enum BillingMethod: string
{
    case Monthly = 'monthly';
    case Annually = 'annually';
}
