<?php

namespace App\Eloquents\Line;

use App\Contracts\Line\IWebhookEvent;
use App\Eloquents\Eloquent;
use App\Traits\Line\WebhookEventEloquent;

class UnfollowEvent extends Eloquent implements IWebhookEvent
{
    use WebhookEventEloquent;

    protected $table = 'line_unfollow_events';

    protected $fillable = [
        'type',
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
