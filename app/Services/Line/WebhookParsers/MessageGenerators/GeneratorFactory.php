<?php

namespace App\Services\Line\WebhookParsers\MessageGenerators;

use App\Contracts\Line\MessageGenerator;
use App\Exceptions\Line\UndefinedMessageTypeException;

class GeneratorFactory
{
    /**
     * @param string $type
     *
     * @return MessageGenerator
     */
    public static function make(string $type): MessageGenerator
    {
        switch ($type) {
            case 'text':
                return app(TextGenerator::class);
            case 'sticker':
                return app(StickerGenerator::class);
            default:
                throw new UndefinedMessageTypeException("undefined message type [{$type}]");
        }
    }
}
