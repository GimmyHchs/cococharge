<?php

namespace App\Contracts\Line;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface Message
{
    /**
     * @return BelongsTo
     */
    public function messageEvent(): BelongsTo;

    /**
     * @return string
     */
    public function getReverseRelationName(): string;
}
