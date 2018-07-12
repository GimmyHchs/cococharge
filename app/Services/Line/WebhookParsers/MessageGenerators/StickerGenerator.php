<?php

namespace App\Services\Line\WebhookParsers\MessageGenerators;

use App\Contracts\Line\Message;
use App\Contracts\Line\MessageGenerator;
use App\Eloquents\Line\Messages\LineSticker;

class StickerGenerator implements MessageGenerator
{
    /**
     * @param array $message
     *
     * @return Message
     */
    public function generate(array $message): Message
    {
        return new LineSticker([
            'message_id' => array_get($message, 'id'),
            'type' => array_get($message, 'type'),
            'package_id' => array_get($message, 'packageId'),
            'sticker_id' => array_get($message, 'stickerId'),
        ]);
    }
}
