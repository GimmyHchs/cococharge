<?php

namespace App\Services\Line\WebhookParsers\MessageParsers;

use App\Contracts\Line\Message;
use App\Contracts\Line\MessageParser;
use App\Eloquents\Line\Messages\LineText;

class TextParser implements MessageParser
{
    /**
     * @param array $message
     *
     * @return Message
     */
    public function parse(array $message): Message
    {
        return new LineText([
            'message_id' => array_get($message, 'id'),
            'text' => array_get($message, 'text'),
            'type' => array_get($message, 'type'),
        ]);
    }
}
