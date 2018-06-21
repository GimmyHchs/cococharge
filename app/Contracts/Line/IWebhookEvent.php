<?php

namespace App\Contracts\Line;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use stdClass;

interface IWebhookEvent
{
    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return stdClass
     */
    public function getOriginData(): stdClass;

    /**
     * @return BelongsTo
     */
    public function lineAccount(): BelongsTo;
}
