<?php
namespace App\Support;

use Brick\Money\Money as MoneyMoney;
use Thunk\Verbs\SerializedByVerbs;

class Money implements ToFromArray
{
    use ToFromArrayVerbs;

    public function __construct(public MoneyMoney $money)
    {

    }

    public static function of($amount, $currency)
    {
        return new static(MoneyMoney::of($amount, $currency));
    }

    public function toArray(): array {
        return [
            'amount' => $this->money->getAmount()->toInt(),
            'currency' => $this->money->getCurrency()->getCurrencyCode(),
        ];
    }

    public static function fromArray(array $data): static {
        return new static(MoneyMoney::of($data['amount'], $data['currency']));
    }
}
