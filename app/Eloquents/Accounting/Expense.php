<?php

namespace App\Eloquents\Accounting;

use App\Contracts\Accounting\BillRecord;
use App\Eloquents\Eloquent;
use App\Traits\Accounting\BillRecordEloquent;

class Expense extends Eloquent implements BillRecord
{
    use BillRecordEloquent;

    const CATEGORY_TYPE = 'expense';

    protected $table = 'expenses';

    protected $fillable = [
        'wallet_id',
        'category_id',
        'amount',
    ];
}
