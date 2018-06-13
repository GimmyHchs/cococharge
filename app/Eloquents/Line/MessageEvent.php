<?php

namespace App\Eloquents\Line;

use App\Contracts\Line\IWebhookEvent;
use App\Eloquents\Eloquent;
use App\Eloquents\Line\Messages\LineText;
use App\Traits\Line\WebhookEventEloquent;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MessageEvent extends Eloquent implements IWebhookEvent
{
    use WebhookEventEloquent;

    protected $table = 'line_message_events';

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

    /**
     * @return HasOne
     */
    public function lineText(): HasOne
    {
        return $this->hasOne(LineText::class, 'event_id');
    }
}
