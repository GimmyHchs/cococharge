<?php

namespace App\Services\Line\WebhookParsers\MessageGenerators;

use App\Contracts\Line\IMessage;
use App\Contracts\Line\IMessageGenerator;
use App\Eloquents\Line\Messages\LineSticker;

class StickerGenerator implements IMessageGenerator
{
    /**
     * @param array $message
     *
     * @return IMessage
     */
    public function generate(array $message): IMessage
    {
        return new LineSticker([
            'message_id' => array_get($message, 'id'),
            'type' => array_get($message, 'type'),
            'package_id' => array_get($message, 'packageId'),
            'sticker_id' => array_get($message, 'stickerId'),
        ]);
    }
}
