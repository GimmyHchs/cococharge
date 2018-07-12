<?php

namespace App\Contracts\Accounting;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface BillRecord
{
    /**
     * @return BelongsTo
     */
    public function wallet(): BelongsTo;

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo;

    /**
     * @return string
     */
    public function getCategoryType(): string;
}
