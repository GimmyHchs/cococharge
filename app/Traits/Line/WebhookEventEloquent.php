<?php

namespace App\Traits\Line;

use App\Eloquents\Line\LineAccount;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use stdClass;

trait WebhookEventEloquent
{
    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getSourceId(): string
    {
        return $this->source_id;
    }

    /**
     * @return string
     */
    public function getSourceType(): string
    {
        return $this->source_type;
    }

    /**
     * @return stdClass
     */
    public function getOriginData(): stdClass
    {
        return $this->origin_data;
    }

    /**
     * @return BelongsTo
     */
    public function lineAccount(): BelongsTo
    {
        return $this->belongsTo(LineAccount::class);
    }
}
