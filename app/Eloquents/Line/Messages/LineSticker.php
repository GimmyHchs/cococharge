<?php

namespace App\Eloquents\Line\Messages;

use App\Contracts\Line\IMessage;
use App\Eloquents\Eloquent;
use App\Eloquents\Line\MessageEvent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LineSticker extends Eloquent implements IMessage
{
    protected $table = 'line_message_stickers';

    protected $fillable = [
        'event_id',
        'message_id',
        'type',
        'package_id',
        'sticker_id',
    ];

    /**
     * @return BelongsTo
     */
    public function messageEvent(): BelongsTo
    {
        return $this->belongsTo(MessageEvent::class, 'event_id');
    }

    /**
     * @return string
     */
    public function getReverseRelationName(): string
    {
        return 'lineSticker';
    }
}
