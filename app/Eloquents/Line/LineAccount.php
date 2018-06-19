<?php

namespace App\Eloquents\Line;

use App\Eloquents\Eloquent;

class LineAccount extends Eloquent
{
    protected $table = 'line_accounts';

    protected $fillable = [
        'type',
        'line_id',
    ];
}
