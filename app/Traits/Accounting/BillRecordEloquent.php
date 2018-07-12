<?php

namespace App\Traits\Accounting;

use App\Eloquents\Accounting\Wallet;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BillRecordEloquent
{
    /**
     * @return BelongsTo
     */
    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }
}
