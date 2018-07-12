<?php

namespace App\Traits\Accounting;

use App\Eloquents\Accounting\Category;
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

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->where('type', self::CATEGORY_TYPE);
    }

    /**
     * @return string
     */
    public function getCategoryType(): string
    {
        return self::CATEGORY_TYPE;
    }
}
