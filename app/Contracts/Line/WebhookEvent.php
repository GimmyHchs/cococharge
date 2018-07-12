<?php

namespace App\Contracts\Line;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use stdClass;

interface WebhookEvent
{
    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return string
     */
    public function getSourceId(): string;

    /**
     * @return string
     */
    public function getSourceType(): string;

    /**
     * @return stdClass
     */
    public function getOriginData(): stdClass;

    /**
     * @return BelongsTo
     */
    public function lineAccount(): BelongsTo;
}
