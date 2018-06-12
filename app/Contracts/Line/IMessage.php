<?php

namespace App\Contracts\Line;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface IMessage
{
    /**
     * @return BelongsTo
     */
    public function messageEvent(): BelongsTo;
}
