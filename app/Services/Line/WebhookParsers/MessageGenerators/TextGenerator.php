<?php

namespace App\Services\Line\WebhookParsers\MessageGenerators;

use App\Contracts\Line\Message;
use App\Contracts\Line\MessageGenerator;
use App\Eloquents\Line\Messages\LineText;

class TextGenerator implements MessageGenerator
{
    /**
     * @param array $message
     *
     * @return Message
     */
    public function generate(array $message): Message
    {
        return new LineText([
            'message_id' => array_get($message, 'id'),
            'text' => array_get($message, 'text'),
            'type' => array_get($message, 'type'),
        ]);
    }
}
