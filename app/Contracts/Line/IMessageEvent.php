<?php

namespace App\Contracts\Line;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface IMessageEvent
{
    /**
     * @return BelongsTo
     */
    public function messageEvent(): BelongsTo;
}
