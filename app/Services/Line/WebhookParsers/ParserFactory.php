<?php

namespace App\Services\Line\WebhookParsers;

use App\Contracts\Line\IWebhookParser;
use Exception;

class ParserFactory
{
    /**
     * @param string $type
     *
     * @return IWebhookParser
     */
    public static function make(string $type): IWebhookParser
    {
        switch ($type) {
            case 'join':
                return app(JoinParser::class);
            default:
                throw new Exception("undefined webhook type {$type}");
        }
    }
}
