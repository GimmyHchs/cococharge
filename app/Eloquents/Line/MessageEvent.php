<?php

namespace App\Eloquents\Line;

use App\Contracts\Line\IReplyableEvent;
use App\Contracts\Line\IWebhookEvent;
use App\Eloquents\Eloquent;
use App\Eloquents\Line\Messages\LineSticker;
use App\Eloquents\Line\Messages\LineText;
use App\Traits\Line\ReplyableEventEloquent;
use App\Traits\Line\WebhookEventEloquent;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MessageEvent extends Eloquent implements IWebhookEvent, IReplyableEvent
{
    use WebhookEventEloquent, ReplyableEventEloquent;

    protected $table = 'line_message_events';

    protected $fillable = [
        'line_account_id',
        'type',
        'message_type',
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

    /**
     * @return HasOne
     */
    public function lineSticker(): HasOne
    {
        return $this->hasOne(LineSticker::class, 'event_id');
    }
}
