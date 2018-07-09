<?php

namespace App\Eloquents\Accounting;

use App\Eloquents\Eloquent;
use App\Eloquents\Line\LineAccount;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wallet extends Eloquent
{
    protected $table = 'wallets';

    protected $fillable = [
        'line_account_id',
        'balance',
    ];

    /**
     * @return BelongsTo
     */
    public function lineAccount(): BelongsTo
    {
        return $this->belongsTo(LineAccount::class);
    }
}
