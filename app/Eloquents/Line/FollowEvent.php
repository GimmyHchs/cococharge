<?php

namespace App\Eloquents\Line;

use App\Contracts\Line\IWebhookEvent;
use App\Eloquents\Eloquent;
use App\Traits\Line\WebhookEventEloquent;

class FollowEvent extends Eloquent implements IWebhookEvent
{
    use WebhookEventEloquent;

    protected $table = 'line_follow_events';

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
