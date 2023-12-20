<?php

namespace App\Support;

use Glhd\Bits\Snowflake;
use Thunk\Verbs\Support\PendingEvent;

trait EventCannon
{
    public function fireThis()
    {
        $this->id ??= Snowflake::make()->id();

        $pending = PendingEvent::make($this);

        return $pending->fire();
    }
}
