<?php

namespace App\Eloquents\Line;

use App\Contracts\Line\IWebhookEvent;
use App\Eloquents\Eloquent;

class JoinEvent extends Eloquent implements IWebhookEvent
{
    protected $table = 'line_join_events';

    protected $fillable = [
        'type',
        'reply_token',
        'timestamp',
        'source_type',
        'source_id',
    ];
}
