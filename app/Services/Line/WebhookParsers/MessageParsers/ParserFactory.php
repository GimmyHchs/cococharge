<?php

namespace App\Services\Line\WebhookParsers\MessageParsers;

use App\Contracts\Line\MessageParser;
use App\Exceptions\Line\UndefinedMessageTypeException;

class ParserFactory
{
    /**
     * @param string $type
     *
     * @return MessageParser
     */
    public static function make(string $type): MessageParser
    {
        switch ($type) {
            case 'text':
                return app(TextParser::class);
            case 'sticker':
                return app(StickerParser::class);
            default:
                throw new UndefinedMessageTypeException("undefined message type [{$type}]");
        }
    }
}
