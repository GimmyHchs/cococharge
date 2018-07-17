<?php

namespace App\Services\Line\WebhookParsers\MessageParsers;

use App\Contracts\Line\Message;
use App\Contracts\Line\MessageParser;
use App\Eloquents\Line\Messages\LineSticker;

class StickerParser implements MessageParser
{
    /**
     * @param array $message
     *
     * @return Message
     */
    public function parse(array $message): Message
    {
        return new LineSticker([
            'message_id' => array_get($message, 'id'),
            'type' => array_get($message, 'type'),
            'package_id' => array_get($message, 'packageId'),
            'sticker_id' => array_get($message, 'stickerId'),
        ]);
    }
}
