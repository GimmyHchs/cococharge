<?php

namespace App\Eloquents\Line;

use App\Contracts\Line\IReplyableEvent;
use App\Contracts\Line\IWebhookEvent;
use App\Eloquents\Eloquent;
use App\Traits\Line\ReplyableEventEloquent;
use App\Traits\Line\WebhookEventEloquent;

class JoinEvent extends Eloquent implements IWebhookEvent, IReplyableEvent
{
    use WebhookEventEloquent, ReplyableEventEloquent;

    protected $table = 'line_join_events';

    protected $fillable = [
        'type',
        'reply_token',
        'timestamp',
        'source_type',
        'source_id',
        'origin_data',
    ];

    protected $dates = [
        'timestamp',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'origin_data' => 'object',
    ];
}
