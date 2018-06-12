<?php

namespace App\Services\Line\WebhookParsers\MessageGenerators;

use App\Contracts\Line\IMessage;
use App\Contracts\Line\IMessageGenerator;
use App\Eloquents\Line\Messages\Text;

class TextGenerator implements IMessageGenerator
{
    /**
     * @param array $message
     *
     * @return IMessage
     */
    public function generate(array $message): IMessage
    {
        return new Text([
            'message_id' => array_get($message, 'id'),
            'text' => array_get($message, 'text'),
            'type' => array_get($message, 'type'),
        ]);
    }
}
