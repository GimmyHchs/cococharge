<?php

namespace App\Contracts\Accounting;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface BillRecord
{
    /**
     * @return BelongsTo
     */
    public function wallet(): BelongsTo;
}
